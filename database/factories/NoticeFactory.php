<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notice>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
//            'category_id' => Category::factory(),
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'published'   => $this->faker->boolean(),
        ];
    }
}
