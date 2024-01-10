<?php


namespace App\Http\Controllers\V1\Sms;

use App\Enums\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Http\Resources\ReportResource;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function __invoke(ReportRequest $request): JsonResponse
    {

        return successResponse([
            'reports' => ReportResource::collection($this->filter($request->date))
        ], HttpCode::CREATED);
    }

    protected function filter(?string $date)
    {
        if (!$date) {
            //son 10 günlük rapor
            $date = date('Y-m-d', strtotime('-10 days'));
        }

        return request()->user->reports()->where('send_date', '>=', $date)->get();

    }
}
