<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="SMS",
 *     description="SMS model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="SMS ID",
 *         example="1"
 *     ),
 *     @OA\Property(
 *     property="user_id",
 *     type="integer",
 *     description="User ID",
 *     example="1"
 *   ),
 *     @OA\Property(
 *     property="number",
 *     type="string",
 *     description="SMS number",
 *     example="905555555555"
 *  ),
 *     @OA\Property(
 *     property="message",
 *     type="string",
 *     description="SMS message",
 *     example="Hello world"
 * ),
 *     @OA\Property(
 *     property="send_time",
 *     type="string",
 *     description="SMS send time",
 *     example="2021-01-01 00:00:00"
 * ),
 *     @OA\Property(
 *     property="status",
 *     type="integer",
 *     ref="#/components/schemas/SmsStatus",
 *     description="SMS status",
 *     example="1"
 * ),
 * )
 *
 */
class SMS extends Model
{
    use HasFactory;

    protected $table = 'sms';
    protected $fillable = [
        'user_id',
        'number',
        'message',
        'send_time',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');
    }
}
