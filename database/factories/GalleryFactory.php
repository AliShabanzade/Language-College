<?php

namespace Database\Factories;

use App\Actions\Translation\SetTranslationAction;
use App\Http\Middleware\EncryptCookies;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
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
            'published'   => fake()->boolean(),
            'category_id' => Category::factory(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Gallery $gallery){


            SetTranslationAction::run($gallery, [
                'fa' => [
                    [
                        'key'   => 'title',
                        'value' => fake()->sentence,
                    ],
                    [
                        'key'   => 'description',
                        'value' => fake()->text(),
                    ],
                ],
                'en' => [
                    [
                        'key'   => 'title',
                        'value' => fake()->sentence,
                    ],
                    [
                        'key'   => 'description',
                        'value' => fake()->text(),
                    ],
                ]

            ]);

        });
    }
}

