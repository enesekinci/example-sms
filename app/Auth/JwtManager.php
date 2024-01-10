<?php

namespace App\Auth;

use App\Enums\JwtType;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

final class JwtManager
{
    protected static self|null $instance = null;

    final private function __construct()
    {
    }

    public static function getInstance(): JwtManager
    {
        return JwtManager::$instance ??= new JwtManager;
    }

    public static function __callStatic($name, $arguments)
    {
        return JwtManager::getInstance()->$name(...$arguments);
    }

    /**
     * @throws Exception
     */
    public static function generateToken(string $email, JwtType $type): string
    {
        // 1 saatlik bir jwt oluşturuyoruz. 3600 saniye verilebilir.
        // 6 saatlik bir jwt oluşturmak için 21600 saniye verilebilir.

        if ($type != JwtType::access && $type != JwtType::refresh) {
            throw new Exception('Invalid token type');
        }

        $payload = [
            'type' => $type, // 'access' or 'refresh
            'iat' => time(),
            'exp' => time() + $type->getExp(),
            'email' => $email,
        ];

        return JWT::encode($payload, env('JWT_KEY'), env('JWT_ALGORITHM'));
    }

    /**
     * @throws Exception
     */
    public static function generateAccessToken(string $email): string
    {
        return self::generateToken($email, JwtType::access);
    }

    /**
     * @throws Exception
     */
    public static function generateRefreshToken(string $email): string
    {
        return self::generateToken($email, JwtType::refresh);
    }

    public static function decodeToken(string $token): stdClass
    {
        return JWT::decode($token, new Key(env('JWT_KEY'), env('JWT_ALGORITHM')));
    }
}
