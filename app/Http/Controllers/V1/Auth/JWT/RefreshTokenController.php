<?php

namespace App\Http\Controllers\V1\Auth\JWT;

use App\Auth\JwtManager;
use App\Enums\HttpCode;
use App\Enums\JwtType;
use App\Enums\ResponseMessage as RM;
use App\Http\Controllers\Controller;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;

class RefreshTokenController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(RefreshTokenRequest $request): JsonResponse
    {
        $data = $request->validated();

        $email = $data['email'];
        $password = $data['password'];

        $auth = auth()->attempt(['email' => $email, 'password' => $password]);
        if (!$auth) {
            return errorResponse(RM::USER_IS_NOT_AUTHORIZED, HttpCode::UNAUTHORIZED);
        }

        $user = auth()->user();

        $token = JwtManager::generateRefreshToken($email);

        return successResponse([
            'type' => JwtType::refresh,
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }
}
