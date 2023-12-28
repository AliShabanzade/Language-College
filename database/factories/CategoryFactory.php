<?php

namespace Database\Factories;

use App\Enums\TableCategoryFieldTypeEnum;
use App\Models\Blog;
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
            'published' => fake()->boolean(),
            'type'      => fake()->randomElement([TableCategoryFieldTypeEnum::BLOG->value, TableCategoryFieldTypeEnum::BOOK->value, TableCategoryFieldTypeEnum::FAQ->value]),
        ];
    }
}
