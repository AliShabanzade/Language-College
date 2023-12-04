<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use HasTranslationAuto, SoftDeletes;

    private array $translatable = ['title'];

    protected $fillable = ['published', 'parent_id', 'slug', 'type'];

    public function scopeWithRelations(Builder $query, ...$relations): Builder
    {
        return $query->with($relations);
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

}
