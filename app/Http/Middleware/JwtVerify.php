<?php

namespace App\Http\Middleware;

use App\Auth\JwtToken;
use App\Enums\HttpCode;
use App\Enums\ResponseMessage as RM;
use App\Models\User;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtVerify
{
    public function handle(Request $request, Closure $next): Response
    {
        try {

            $content = JWT::decode(JwtToken::get(), new Key(env('JWT_SECRET'), env('JWT_ALGORITHM')));

            JwtToken::setContent($content);

            JwtToken::setType($content->type);

            $user = User::query()
                ->where('email', $content->email)
                ->first();

            if (!$user) {
                return errorResponse(RM::USER_IS_NOT_AUTHENTICATED, HttpCode::UNAUTHORIZED);
            }

            $request->merge(['user' => $user]);

            return $next($request);
        } catch (ExpiredException $exception) {
            writeToLog($exception);
            return errorResponse(RM::TOKEN_IS_EXPIRED, HttpCode::UNAUTHORIZED);
        } catch (Exception $e) {
            writeToLog($e);
            return errorResponse(RM::USER_IS_NOT_AUTHENTICATED, HttpCode::UNAUTHORIZED);
        }
    }
}
