<?php

namespace App\Enums;

use Exception;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SmsStatus",
 *     title="SmsStatus",
 *     description="Sms status",
 *     @OA\Property(property="WAITING", type="integer", example=0),
 *     @OA\Property(property="SENT", type="integer", example=1),
 *     @OA\Property(property="FAILED", type="integer", example=2),
    * ),
 *
 */
enum SmsStatus: int
{
    case WAITING = 0;
    case SENT = 1;
    case FAILED = 2;

    public function isSent(): bool
    {
        return $this->value == self::SENT;
    }

    public function isNotSent(): bool
    {
        return $this->isWaiting() || $this->isFailed();
    }

    public function isWaiting(): bool
    {
        return $this->value == self::WAITING;
    }

    public function isFailed(): bool
    {
        return $this->value == self::FAILED;
    }

    /**
     * @throws Exception
     */
    public function toText(): string
    {
        return match ($this->value) {
            0 => 'Bekliyor',
            1 => 'Gönderildi',
            2 => 'Başarısız',
            default => throw new Exception('Undefined status'),
        };
    }

}
