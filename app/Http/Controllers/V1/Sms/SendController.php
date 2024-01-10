<?php


namespace App\Http\Controllers\V1\Sms;

use App\Enums\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendSmsRequest;
use App\Http\Resources\SmsResource;
use App\Jobs\SendSmsJob;
use App\Models\SMS;
use Illuminate\Http\JsonResponse;

class SendController extends Controller
{
    public function __invoke(SendSmsRequest $request): JsonResponse
    {
        $sms = SMS::query()->create($request->validated());

        SendSmsJob::dispatch($sms);

        return successResponse([
            'sms' => new SmsResource($sms),
        ], HttpCode::CREATED);
    }
}
