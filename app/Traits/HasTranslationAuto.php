<?php

namespace App\Traits;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTranslationAuto
{
    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable')
                    ->where('locale', app()->getLocale());
    }
}
