<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,HasSlug,HasTranslationAuto,SoftDeletes;

    protected $fillable= ['type','slug'];
    public function terms(): HasMany
    {
        return $this->hasMany(Term::class);
    }
}
