<?php

namespace App\Traits;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTranslation
{
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable')
                    ->where('locale', app()->getLocale());
    }
}
