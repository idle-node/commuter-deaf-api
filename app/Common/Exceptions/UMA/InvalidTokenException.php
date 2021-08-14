<?php

namespace App\Common\Exceptions\UMA;


use App\Common\Exceptions\BaseException;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/25/2021 2021 16:49:50
 *
 * TokenUnauthorizedException
 * Insert Description Here...
 */
class InvalidTokenException extends BaseException
{
    public function __construct()
    {
        parent::__construct(
            "OTP Token is invalid",
            "UMA0004"
        );
    }
}
