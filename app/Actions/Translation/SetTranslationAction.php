<?php

namespace App\Actions\Translation;


use App\Traits\HasTranslationAuto;
use Lorisleiva\Actions\Concerns\AsAction;

class SetTranslationAction
{
    use AsAction;
    use HasTranslationAuto;

    public static function handle($model,array $translations): void
    {
        foreach ($translations as $locale=>$rows) {
            foreach ($rows as $row) {
                $model->translations()->updateOrCreate(
                    [
                        'key'    => $row['key'],
                        'locale' => $locale,
                    ],
                    [
                        'value' => $row['value'],
                    ]
                );
            }
       }
    }

}
