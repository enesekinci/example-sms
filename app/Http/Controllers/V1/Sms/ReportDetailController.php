<?php


namespace App\Http\Controllers\V1\Sms;

use App\Enums\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportDetailRequest;
use Illuminate\Http\JsonResponse;

class ReportDetailController extends Controller
{
    public function __invoke(ReportDetailRequest $request): JsonResponse
    {
        return successResponse([
        ], HttpCode::CREATED);
    }
}
