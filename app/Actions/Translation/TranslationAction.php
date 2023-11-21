<?php

namespace App\Actions\Translation;

use App\Traits\HasTranslation;
use App\Traits\HasTranslationAuto;
use Lorisleiva\Actions\Concerns\AsAction;

class TranslationAction
{
    use AsAction;
    use HasTranslationAuto;



    public static function handle($model, array $data): void
    {

        foreach ($data['values'] as $locale=>$value){

            $model->translation()->updateOrCreate(
                [
                    'key' => $data['key'],
                    'locale' => $locale,
                ],
                [
                    'value' => $value['value'] ?? null,
                ]
            );
        }

    }


    public static function get($model,$key):string
    {
        return   $model->translation()->where('key',$key)->first()->value ?? '';
    }
}
