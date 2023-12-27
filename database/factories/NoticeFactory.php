<?php

namespace Database\Factories;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Category;
use App\Models\Notice;
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
            'category_id' => Category::factory(),
            'published'   => $this->faker->boolean(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Notice $notice) {

            SetTranslationAction::run($notice, [
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
