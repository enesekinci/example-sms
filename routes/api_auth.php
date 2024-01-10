<?php

use App\Http\Controllers\V1\Auth\JWT\RefreshTokenController;
use App\Http\Controllers\V1\Auth\JWT\TokenController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Middleware\ExceptionHandler;
use App\Http\Middleware\JwtHandler;
use App\Http\Middleware\JwtRefreshToken;
use App\Http\Middleware\JwtVerify;
use Illuminate\Support\Facades\Route;

Route::middleware(ExceptionHandler::class)->group(function () {

    Route::prefix('auth')->as('auth.')->group(function () {

        Route::prefix('token')->group(function () {

            Route::post('/generate/refresh-token', RefreshTokenController::class)->name('refresh-token');

            Route::middleware([JwtHandler::class, JwtVerify::class])->group(function () {

                Route::middleware([JwtRefreshToken::class])->group(function () {

                    Route::post('/generate/token', TokenController::class)->name('token');
                });
            });
        });

        Route::post('register', RegisterController::class)->name('register');
    });
});
