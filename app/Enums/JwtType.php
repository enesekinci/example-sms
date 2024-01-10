<?php

namespace App\Enums;

enum JwtType: string
{
    case access = 'access';
    case refresh = 'refresh';

    public function toString(): string
    {
        return $this->value;
    }

    public function getExp(): int
    {
        return match ($this) {
            JwtType::access => 3600,
            JwtType::refresh => 21600,
        };
    }

    // fromString
    public static function fromString(string $type)
    {
        return match ($type) {
            JwtType::access->toString() => JwtType::access,
            JwtType::refresh->toString() => JwtType::refresh,
            default => throw new \Exception('Invalid JWT type'),
        };
    }
}
