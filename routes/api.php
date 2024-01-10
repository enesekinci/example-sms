<?php

use App\Http\Controllers\V1\Sms\ReportController;
use App\Http\Controllers\V1\Sms\ReportDetailController;
use App\Http\Controllers\V1\Sms\SendController;
use App\Http\Middleware\JwtAccessToken;
use App\Http\Middleware\JwtHandler;
use App\Http\Middleware\JwtVerify;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

require_once __DIR__ . '/api_auth.php';

Route::middleware([JwtHandler::class, JwtVerify::class, JwtAccessToken::class])->group(function () {

    Route::prefix('v1')->group(function () {

        Route::prefix('sms')->group(function () {
            Route::post('send', SendController::class);
            Route::get('report', ReportController::class);
            Route::get('report/{id}', ReportDetailController::class);

        });
    });

});


