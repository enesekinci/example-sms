<?php

namespace App\Auth;

use App\Enums\JwtType;

final class JwtToken
{
    static protected string $token = '';
    static protected JwtType $type = JwtType::access;
    static protected array|object $content = [];

    public static function set(string $token): void
    {
        self::$token = $token;
    }

    public static function get(): string
    {
        return self::$token;
    }

    public static function setType(string $type): void
    {
        $type = JwtType::fromString($type);

        self::$type = $type;
    }

    public static function getType(): JwtType
    {
        return self::$type;
    }

    public static function setContent(array|object $content)
    {
        self::$content = \is_object($content) ? (array) $content : $content;

        if (isset(self::$content['type'])) {
            unset(self::$content['type']);
        }
    }

    public static function getContent()
    {
        return self::$content;
    }
}
