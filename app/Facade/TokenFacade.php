<?php


namespace App\Facade;


use App\Model\UMA\User;
use App\Repository\UMA\Impl\TokenRepositoryImpl;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;

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

    /**
     * @throws Exception
     */
    public function createPublicToken(User $user): string {

        $mask = Uuid::uuid4()->toString();
        $real_token = $this->jwtEncoder($user);

        (new TokenRepositoryImpl())->createToken(
            $real_token,
            $mask,
            (new DateTime())->setTimestamp(time() + (3600 * 24 * 7))
        );

        return $mask;
    }

    public function decodePublicToken(string $token): User {



    }
}

