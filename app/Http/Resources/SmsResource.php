<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $number
 * @property mixed $message
 * @property mixed $send_time
 * @property mixed $status
 */
class SmsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'message' => $this->message,
            'send_time' => $this->send_time,
            'status' => $this->status,
        ];
    }
}
