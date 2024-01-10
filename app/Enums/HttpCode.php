<?php

namespace App\Enums;

use Exception;

enum HttpCode: int
{
    case OK = 200;
    case CREATED = 201;

    case DELETED = 204;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    case UNPROCESSABLE_ENTITY = 422;
    case TOO_MANY_REQUESTS = 429;
    case INTERNAL_SERVER_ERROR = 500;

    public function toString(): string
    {
        return (string)$this->value;
    }

    public function toInt(): int
    {
        return $this->value;
    }

    /**
     * @throws Exception
     */
    public static function fromInt(int $code): HttpCode
    {
        return match ($code) {
            HttpCode::OK->toInt() => HttpCode::OK,
            HttpCode::BAD_REQUEST->toInt() => HttpCode::BAD_REQUEST,
            HttpCode::UNAUTHORIZED->toInt() => HttpCode::UNAUTHORIZED,
            HttpCode::FORBIDDEN->toInt() => HttpCode::FORBIDDEN,
            HttpCode::NOT_FOUND->toInt() => HttpCode::NOT_FOUND,
            HttpCode::METHOD_NOT_ALLOWED->toInt() => HttpCode::METHOD_NOT_ALLOWED,
            HttpCode::INTERNAL_SERVER_ERROR->toInt() => HttpCode::INTERNAL_SERVER_ERROR,
            default => throw new Exception('Invalid HTTP code'),
        };
    }
}
