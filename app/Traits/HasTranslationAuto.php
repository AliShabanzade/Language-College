<?php

namespace App\Traits;

use App\Actions\Translation\TranslationAction;
use App\Models\Translation;

trait HasTranslationAuto{
    public function getAttribute($key)
    {
        if (in_array($key, $this->translatable)) {
            return TranslationAction::get($this, $key);
        }
        return $this->attributes[$key];
    }
    public function setAttribute($key,$value)
    {
        if(in_array($key,$this->translatable)){

            return TranslationAction::run($this,$value);
        }
        $this->attributes[$key]=$value;
    }

    public function translations()
    {
        return $this->morphMany(Translation::class,'translatable')
            ->where('locale',app()->getLocale());
    }

}
