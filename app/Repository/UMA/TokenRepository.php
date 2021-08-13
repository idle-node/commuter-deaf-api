<?php


namespace App\Repository\UMA;


use App\Model\UMA\User;
use DateTime;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/25/2021 2021 16:11:31
 *
 * TokenRepository
 * Insert Description Here...
 */
interface TokenRepository
{
    /**
     * createToken
     *
     * A function to create new Token for User.
     *
     * @param string $real_token
     * @param string $uuid
     * @param DateTime $expired_time
     * @return string
     */
    public function createToken(
        string $real_token,
        string $uuid,
        DateTime $expired_time
    ): string;

    /**
     * revokeToken
     *
     * A function to revoke a token by set is_expired to 1.
     *
     * @param string $token
     */
    public function revokeToken(string $token): void;

    /**
     * revokeAllToken
     *
     * A function to revoke set all token to is_expired to 1.
     */
    public function revokeAllToken(): void;

    /**
     * getJWTByToken
     *
     * A function
     *
     * @param string $token
     * @return string
     */
    public function getJWTByToken(string $token): string;
}
