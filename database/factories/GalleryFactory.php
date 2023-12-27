<?php

namespace Database\Factories;

use App\Http\Middleware\EncryptCookies;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
//            'slug'        => \Str::random(),
            'user_id'     => User::factory(),
            'published'   => fake()->boolean(),
            'category_id' => Category::factory(),
        ];
    }
}
