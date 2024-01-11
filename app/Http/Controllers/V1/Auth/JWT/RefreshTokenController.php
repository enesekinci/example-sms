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

/**
 * RefreshToken
 *
 * @OA\Post(
 *     path="/auth/token/generate/refresh-token",
 *     tags={"Auth"},
 *     summary="Refresh token",
 *     operationId="refreshToken",
 *     @OA\RequestBody(
 *     description="Refresh token",
 *     required=true,
 *     @OA\JsonContent(
 *     required={"email", "password"},
 *     @OA\Property(property="email", type="string", example="test@test.com"),
 *     @OA\Property(property="password", type="string", example="password"),
 *     ),
 *     ),
 *     @OA\Response(
 *     response=200,
 *     description="Success",
 *     @OA\JsonContent(
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="type", type="string", example="refresh"),
 *     @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"),
 *     @OA\Property(property="user", type="object"),
 *     ),
 *     ),
 *     @OA\Response(
 *     response=401,
 *     description="Unauthorized",
 *     @OA\JsonContent(
 *     @OA\Property(property="message", type="string", example="User is not authorized"),
 *     ),
 *     ),
 *     @OA\Response(
 *     response=422,
 *     description="Unprocessable Entity",
 *     @OA\JsonContent(
 *     @OA\Property(property="message", type="string", example="The given data was invalid."),
 *     @OA\Property(property="errors", type="object"),
 *     ),
 *     ),
 *     security={
 *     {"bearerAuth": {}}
 *     }
 *     )
 *
 */
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
