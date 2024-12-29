<?php

namespace App\Actions\Translation;


use App\Traits\HasTranslationAuto;
use Lorisleiva\Actions\Concerns\AsAction;

class TranslationAction
{
    use AsAction;
    use HasTranslationAuto;

    public static function handle($model, array $data): void
    {

        foreach ($data as $locale => $value) {

            collect($value)->each(function ($item) use ($model, $locale) {

                $model->translation()->updateOrCreate(
                    [
                        'translatable_id' => $model->id,
                        'translatable_type' => get_class($model),
                        'key' => $item['key'],
                        'locale' => $locale,
                    ],
                    [
                        'value' => $item['value'] ?? null,

                    ]
                );
            });

        }


    }


    public static function get($model, $key): string
    {

        return $model->translation()->where('key', $key)->first()->value ?? '';
    }
}
