<?php

namespace App\Actions\Translation;


use App\Traits\HasTranslationAuto;
use Lorisleiva\Actions\Concerns\AsAction;

class SetTranslationAction
{
    use AsAction;
    use HasTranslationAuto;

    public static function handle($model, string $key, string $value): void
    {
        if (!empty($key) && !empty($value)) {
            $model->translations()->updateOrCreate(
                [
                    'key'    => $key,
                    'locale' => app()->getLocale(),
                ],
                [
                    'value' => $value,
                ]
            );
        }
    }

    public static function translate($model, $translation): void
    {
        foreach ($translation[app()->getLocale()] as $item) {
            self::handle($model, $item['key'], $item['value']);
        }
    }
}
