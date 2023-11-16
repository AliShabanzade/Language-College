<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * Define the model's default sta
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => fake()->name(),
            'email'            => fake()->unique()->safeEmail(),
            'mobile'           => fake()->phoneNumber(),
            'block'            => fake()->boolean,
            'mobile_verify_at' => fake()->boolean ? now() : null,
            'password'         => 'password',
            'remember_token'   => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'mobile_verify_at' => null,
        ]);
    }
}
