<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publication extends Model
{
    use HasFactory,HasTranslationAuto,HasSlug;
    protected $fillable=['slug'];
    private array $translatable = [ 'publication'];

    public function books():HasMany
    {
        return $this->hasMany(Book::class);
    }
}
