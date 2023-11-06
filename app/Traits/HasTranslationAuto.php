<?php

namespace App\Traits;

use App\Models\Translation;

trait HasTranslationAuto{

    public function translations()
    {
        return $this->morphMany(Translation::class,'translatable');

    }
    public function translation()
    {
        //dd(app()->getLocale());
        return $this->morphOne(Translation::class,'translatable')
            ->where('locale',app()->getLocale());
    }
}
