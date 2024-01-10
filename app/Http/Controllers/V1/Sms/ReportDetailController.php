<?php


namespace App\Http\Controllers\V1\Sms;

use App\Enums\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\SMS;
use Illuminate\Http\JsonResponse;

class ReportDetailController extends Controller
{
    function __invoke(SMS $sms): JsonResponse
    {
        return successResponse([
            'report' => new ReportResource($sms),
        ], HttpCode::CREATED);
    }
}
