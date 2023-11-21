<?php

namespace App\Traits;

use App\Actions\Translation\TranslationAction;

trait HasGetAttribute
{
    public function getAttribute($key)
    {

        if (in_array($key, $this->translatable)) {
            return TranslationAction::get($this,$key);
        }
        return $this->attributes[$key];
    }
}
