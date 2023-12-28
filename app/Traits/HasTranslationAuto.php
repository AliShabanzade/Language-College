<?php

namespace App\Traits;

use App\Actions\Translation\GetTranslationAction;
use App\Actions\Translation\SetTranslationAction;
use App\Models\Translation;

trait HasTranslationAuto
{
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');

    }
}
