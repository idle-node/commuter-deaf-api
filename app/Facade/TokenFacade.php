<?php


namespace App\Facade;


use Firebase\JWT\JWT;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/24/2021 2021 03:56:51
 *
 * JWT
 * A facade filled with JWT Tokenizer
 */
class TokenFacade
{
    private function jwtEncoder(object $payload): string {

        $jwt_config = (object) [
            "pwd" => $payload,
            "iss" => "laravel-jwt",
            "iat" => time(),
            "exp" => time() + (3600 * 24 * 7) // One week
        ];

        return JWT::encode($jwt_config, env('JWT_SECRET'));
    }

    private function jwtDecoder(string $token): object {
        return JWT::decode($token, env('JWT_SECRET'), ['HS256']);
    }


}
