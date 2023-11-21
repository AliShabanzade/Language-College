<?php

namespace App\Traits;

use App\Actions\Translation\TranslationAction;

trait HasSetAttribute
{
        public function setAttribute($key,$value)
    {
dd($value)
        if(in_array($key,$this->translatable)){
            return TranslationAction::run($this,$value);
        }
        $this->attributes[$key]=$value;

    }
}
