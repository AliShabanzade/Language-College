<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Translation extends Model
{
    use HasFactory;
    protected $fillable= ['translatable_id', 'translatable_type', 'key', 'value', 'locale'];
    public function translatable():MorphTo
    {
        return $this->morphTo();

    }
}
