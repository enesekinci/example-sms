<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\JsonSchema(
 *     title="User",
 *     description="User model",
 *     @OA\Property(
 *     property="id",
 *     type="integer",
 *     description="User ID",
 *     example="1"
 *    ),
 *     @OA\Property(
 *     property="name",
 *     type="string",
 *     description="User name",
 *     example="John Doe"
 *   ),
 *     @OA\Property(
 *     property="email",
 *     type="string",
 *     description="User email",
 *     example="test@test.com",
 *     format="email"
 * ),
 *     @OA\Property(
 *     property="password",
 *     type="string",
 *     description="User password",
 *     example="password"
 * ),
 *     @OA\Property(
 *     property="created_at",
 *     type="string",
 *     description="User created at",
 *     example="2021-01-01 00:00:00"
 * ),
 *     @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     description="User updated at",
 *     example="2021-01-01 00:00:00"
 * )
 * )
 * )
 *
 *
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function reportSMS(): HasMany
    {
        return $this->hasMany(SMS::class, 'user_id', 'id');
    }
}
