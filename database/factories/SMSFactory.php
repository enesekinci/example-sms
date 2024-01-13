<?php

namespace Database\Factories;

use App\Enums\SmsStatus;
use App\Models\SMS;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SMSFactory extends Factory
{
    protected $model = SMS::class;

    public function definition(): array
    {
        return [
            'number' => $this->faker->randomNumber(11),
            'message' => $this->faker->word(),
            'send_time' => Carbon::now(),
            'status' => $this->faker->randomElement([SmsStatus::WAITING, SmsStatus::SENT, SmsStatus::FAILED]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory(),
        ];
    }
}
