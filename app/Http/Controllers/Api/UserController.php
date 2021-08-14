<?php

namespace App\Http\Controllers\Api;

use App\Common\Exceptions\UMA\InvalidTokenException;
use App\Common\Exceptions\UMA\PhoneNumberAlreadyExistsException;
use App\Common\Exceptions\UMA\TokenExpiredException;
use App\Common\Exceptions\UMA\UserNotFoundException;
use App\Facade\BaseResponse;
use App\Facade\OTPHelper;
use App\Facade\TimeFacade;
use App\Facade\TokenFacade;
use App\Http\Controllers\Controller;
use App\Model\UMA\OTPVerification;
use App\Model\UMA\User;
use App\Repository\UMA\Impl\UserRepositoryImpl;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/24/2021 2021 04:02:53
 *
 * UserController
 * Insert Description Here...
 */
class UserController extends Controller
{
    /**
     * @static
     * 
     * OTP_EXPIRED_TIME in minutes
     */
    const OTP_EXPIRED_TIME = 5;
    
    public function register(Request $request): JsonResponse {
        $this->baseValidator($request, [
            "phone" => "required|digits_between:9,20",
            "fullname" => "required",
            "password" => "required|min:6"
        ]);

        $user = (new UserRepositoryImpl())->findUserByPhone($request->get('phone'));

        if($user){
            throw new PhoneNumberAlreadyExistsException();
        }

        $user = new User();
        $user->phone = $request->get('phone');
        $user->fullname = $request->get('fullname');
        $user->password = Hash::make($request->get('password'), [
            'rounds' => 12,
        ]);
        $user->username = "usr-".$request->get('phone');
        $user->status = User::NOT_ACTIVATED;
        $user->last_active = new DateTime('now');
        $user->save();

        OTPHelper::generateAndSendOTP($user->id);

        return BaseResponse::ok(
            User::find($user->id),
            "Succesfully register new user. OTP Sent.",
            201
        );
    }

    public function inputOTP(Request $request): JsonResponse {
        $this->baseValidator($request, [
            "phone" => "required|digits_between:9,20",
            "otp" => "required|digits:6",
        ]);

        $user = (new UserRepositoryImpl())->findUserByPhone($request->get('phone'));

        if(!$user){
            throw new UserNotFoundException();
        }

        $otp = OTPVerification
                ::where([
                    ['user_id', '=', $user->id],
                ])
                ->orderBy('created_at', 'desc')
                ->get()
                ->first();

        if($otp === null){
            throw new InvalidTokenException();
        }

        if($otp->attempt === 3){
            throw new TokenExpiredException();
        }

        if($otp->otp_code !== $request->get('otp')){
            $otp->attempt = $otp->attempt + 1;
            $otp->save();
            throw new InvalidTokenException();
        }

        /**
         * Check if OTP is expired or not
         */
        if((new TimeFacade())->getCustomTimeWithAddition(new DateTime($otp->created_at), 5, 'M') > new DateTime('now')){
            throw new TokenExpiredException();
        }


        $user->status = User::ACTIVATED;
        $user->updated_at = new DateTime('now');
        $user->save();

        $otp->attempt = 99; // used Well
        $otp->save();

        /**
         * Token Handshake and login
         */

        $token = (new TokenFacade())->createPublicToken($user);

        return BaseResponse::ok(
            [
                "token" => $token
            ],
            "Login success",
            200
        );
    }

}
