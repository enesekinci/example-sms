<?php

namespace App\Http\Middleware;

use App\Auth\JwtToken;
use App\Enums\HttpCode;
use App\Enums\ResponseMessage as RM;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use function errorResponse;
use function writeToLog;

class JwtHandler
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $header = $request->header('Authorization');

            writeToLog(['header' => $header]);

            $token = explode(' ', $header)[1];

            JwtToken::set($token);

        } catch (Throwable $th) {

            writeToLog($th);

            return errorResponse(RM::TOKEN_IS_INVALID, HttpCode::UNAUTHORIZED);
        }

        return $next($request);
    }
}
