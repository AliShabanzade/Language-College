<?php

namespace Database\Factories;

use App\Enums\CategoryEnum;
use App\Models\Book;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
           // 'name'=>fake()->name,
            'published'=>fake()->boolean(),
            'type'=>fake()->randomElement([Book::class ,  Faq::class]),
        ];
    }
}
