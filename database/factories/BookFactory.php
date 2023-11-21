<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name,
            'publication'=>fake()->name(),
            'user_id'=>User::factory(),
            'category_id'=>Category::factory(),
            'inventory'=>rand(10,100),
            'published'=>fake()->boolean,
            'price'=>rand(1000,10000),
            'pages'=>rand(20,200),
            'sales'=>rand(5,90),
            'writer'=>fake()->name,
           // 'slug'=>\Str::random(),
        ];
    }
}
