<?php

namespace App\Traits;

use App\Actions\RelationResolver\RelationResolver;
use App\Actions\Translation\GetTranslationAction;
use App\Actions\Translation\SetTranslationAction;
use App\Actions\Translation\TranslationAction;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;

trait HasTranslationAuto
{
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable')
                    ->where('locale', app()->getLocale());
    }
}
