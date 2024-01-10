<?php

namespace App\Http\Controllers\V1\Auth\JWT;

use App\Auth\JwtManager;
use App\Auth\JwtToken;
use App\Enums\HttpCode;
use App\Enums\JwtType;
use App\Enums\ResponseMessage as RM;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $email = JwtToken::getContent()['email'];

        try {
            $token = JwtManager::generateAccessToken($email);
        } catch (Throwable $e) {
            writeToLog($e);
            return errorResponse(RM::INTERNAL_SERVER_ERROR, HttpCode::INTERNAL_SERVER_ERROR);
        }

        return successResponse([
            'type' => JwtType::access,
            'token' => $token,
            'user' => new UserResource($request->user),
        ]);
    }
}
