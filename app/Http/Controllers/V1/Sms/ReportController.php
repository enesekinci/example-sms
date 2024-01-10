<?php


namespace App\Http\Controllers\V1\Sms;

use App\Enums\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function __invoke(ReportRequest $request): JsonResponse
    {
        //TODO: get date parametresiyle filtreleme yapılacak
        return successResponse([
        ], HttpCode::CREATED);
    }
}
