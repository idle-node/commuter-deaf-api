<?php

namespace App\Facade;

use App\Common\Exceptions\UMA\UserNotFoundException;
use App\Model\UMA\OTPVerification;
use App\Services\TelegramServices;
use App\Model\UMA\User;

class OTPHelper {

    /**
     * Should be multithread or asynchronous if possible
     */
    public static function generateAndSendOTP(int $user_id) {

        $otp_code = "";

        /**
         * Loop 6 times to append new number
         */
        for($i = 0; $i < 6; $i++){
            $otp_code .= strval(rand(0, 9));
        }

        $otp = new OTPVerification();
        $otp->user_id = $user_id;
        $otp->otp_code = $otp_code;
        $otp->attempt = 0;
        $otp->created_at = date('now');
        $otp->save();

        $sender_credential = User::find($user_id);

        if($sender_credential === null){
            throw new UserNotFoundException();
        }

        (new TelegramServices())->sendMessage("Here's your OTP Code for [{$sender_credential->phone}] : {$otp_code}");
    }

}