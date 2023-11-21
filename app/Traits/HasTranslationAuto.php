<?php

namespace App\Traits;

use App\Models\Translation;

trait HasTranslationAuto{


    public function translation()
    {

        return $this->morphOne(Translation::class,'translatable')
            ->where('locale',app()->getLocale());
    }
}
