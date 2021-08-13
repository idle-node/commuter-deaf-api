<?php


namespace App\Repository\UMA\Impl;

use App\Common\Exceptions\UMA\TokenUnauthorizedException;
use App\Model\UMA\BearerToken;
use App\Repository\UMA\TokenRepository;
use DateTime;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/25/2021 2021 16:14:50
 *
 * TokenRepositoryImpl
 * Insert Description Here...
 */
class TokenRepositoryImpl implements TokenRepository
{
    public function createToken(
        string $real_token,
        string $uuid,
        DateTime $expired_time
    ): string
    {
        BearerToken::create([
            "uuid" => $uuid,
            "token" => $real_token,
            "expired_time" => $expired_time
        ]);
    }

    /**
     * @throws TokenUnauthorizedException
     */
    public function revokeToken(string $token): void
    {
        $bearer = BearerToken
                    ::where([
                        ['uuid', '=', $token],
                        ['is_expired', '=', 0],
                        ['expired_time', '>', new DateTime()]
                    ])
                    ->get()
                    ->first();

        if($bearer === null){
            throw (new TokenUnauthorizedException());
        }

        $bearer->is_expired = 1;
        $bearer->save();
    }

    public function revokeAllToken(): void
    {
        BearerToken::update([
            "is_expired" => 1
        ]);
    }

    public function getJWTByToken(string $token): string
    {
        $bearer = BearerToken
            ::where([
                ['uuid', '=', $token],
                ['is_expired', '=', 0],
                ['expired_time', '>', new DateTime()]
            ])
            ->get()
            ->first();


    }
}
