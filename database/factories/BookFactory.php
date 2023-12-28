<?php

namespace Database\Factories;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Book;
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

            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'inventory' => rand(10, 100),
            'published' => fake()->boolean,
            'price' => rand(1000, 10000),
            'pages' => rand(20, 200),
            'sales' => rand(5, 90),

            // 'slug'=>\Str::random(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Book $book) {
            SetTranslationAction::run($book, [
                'fa' => [
                    [
                        'key' => 'title',
                        'value' => fake()->name()
                    ],
                    [
                        'key' => 'writer',
                        'value' => fake()->name()
                    ]
                ],
                'en' => [
                    [
                        'key' => 'writer',
                        'value' => fake()->name()
                    ],
                    [
                        'key' => 'title',
                        'value' => fake()->name()
                    ]
                ]
            ]);

        });

    }
}
