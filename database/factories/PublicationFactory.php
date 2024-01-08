<?php

namespace Database\Factories;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Publication $publication){
            SetTranslationAction::run($publication,[
                'fa'=>[
                    [
                        'key'=> 'publication',
                        'value'=>fake()->name
                    ],

                ],

                'en'=>[
                    [
                        'key'=> 'publication',
                        'value'=>fake()->name
                    ]

                ],
            ]);

        });
    }
}
