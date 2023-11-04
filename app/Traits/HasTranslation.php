<?php
namespace App\Traits;
use App\Models\Translation;
trait HasTranslation{
    public function translations()
    {
        return $this->morphMany(Translation::class,'translatable');

    }
}


