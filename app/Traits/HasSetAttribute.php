<?php

namespace App\Traits;



trait HasSetAttribute
{
        public function setAttribute($key,$value)
    {

        if(in_array($key,$this->translatable)){

            return TranslationAction::run($this,$value);
        }

        $this->attributes[$key]=$value;

    }
}
