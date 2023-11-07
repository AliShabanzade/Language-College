<?php

namespace Database\Factories;

use App\Models\ActivationCode;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivationCodeFactory extends Factory
{
    protected $model = ActivationCode::class;

    public function definition(): array
    {
        return [
            'user_id'=> User::factory(),
            'code' => fake()->randomNumber(4),
            'used' => fake()->boolean,
            'expire_at' =>  now()->addMinutes(2),

        ];
    }
}
