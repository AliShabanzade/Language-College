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
    public function getAttribute($key)
    {

        if (in_array($key, $this->translatable)) {
            return GetTranslationAction::run($this, $key);
        }

        // If the key corresponds to a relationship, return the relationship
        if (method_exists($this, $key)) {
            return $this->getRelationshipFromMethod($key);
        }

        // Otherwise, return the attribute value
        return $this->attributes[$key]??null;
    }

    public function setAttribute($key, $value): void
    {
        if (in_array($key, $this->translatable)) {
            SetTranslationAction::run($this, [
                app()->getLocale() => [
                    'key'   => $key,
                    'value' => $value
                ]
            ]);
            return;
        }
        $this->attributes[$key] = $value;
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable')
                    ->where('locale', app()->getLocale());
    }
}
