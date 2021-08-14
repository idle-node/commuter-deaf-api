<?php

namespace App\Http\Controllers\Api;

use App\Common\Exceptions\UMA\InvalidPasswordException;
use App\Common\Exceptions\UMA\TokenExpiredException;
use App\Common\Exceptions\UMA\UserNotFoundException;
use App\Facade\BaseResponse;
use App\Facade\TokenFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Model\UMA\User;
use App\Facade\Console;
use Illuminate\Support\Facades\Hash;
use App\Repository\UMA\Impl\UserRepositoryImpl;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/24/2021 2021 04:02:53
 *
 * Test
 * Insert Description Here...
 */
class AuthenticationController extends Controller
{
    public function me(Request $request): JsonResponse{
        
        $user_id = (new TokenFacade())->decodePublicToken($request->header('Authorization'))->pyl->id;

        Console::writeLine($request->header('Authorization') . ": ID {$user_id}");

        $user = User::find($user_id);

        if(!$user){
            throw new TokenExpiredException();
        }

        return BaseResponse::ok(
            $user,
            "Here's your data."
        );
    }

    public function login(Request $request): JsonResponse {
        $this->baseValidator($request, [
            "phone" => "required|digits_between:9,20",
            "password" => "required"
        ]);

        $user = (new UserRepositoryImpl())->findUserByPhone($request->get('phone'));

        if(!$user){
            throw new UserNotFoundException();
        }

        if(!Hash::check($request->get('password'), $user->password, [
            'rounds' => 12
        ])){
            throw new InvalidPasswordException();
        }

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
