<?php

namespace Database\Factories;

use App\Models\SmsConfig;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SmsConfigFactory extends Factory
{
    protected $model = SmsConfig::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'password' => bcrypt($this->faker->password()),
            'status' => 'enable',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
