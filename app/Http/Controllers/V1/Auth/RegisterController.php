<?php

namespace App\Http\Controllers\V1\Auth;

use App\Enums\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());

        return successResponse([
            'user' => new UserResource($user),
        ], HttpCode::CREATED);
    }
}
