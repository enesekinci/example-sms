<?php

namespace App\Http\Middleware;

use App\Auth\JwtToken;
use App\Enums\HttpCode;
use App\Enums\JwtType;
use App\Enums\ResponseMessage as RM;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtRefreshToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if (JwtToken::getType() != JwtType::refresh) {
            return errorResponse(RM::TOKEN_MUST_BE_REFRESH);
        }

        return $next($request);
    }
}
