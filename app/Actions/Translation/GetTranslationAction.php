<?php

namespace App\Actions\Translation;


use App\Traits\HasTranslationAuto;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTranslationAction
{
    use AsAction;
    use HasTranslationAuto;

    public static function handle($model, $key): ?string
    {

        return $model->translations()
            ->where('locale', app()->getLocale())
            ->where('key', $key)->first()?->value ?? null;
    }
}
