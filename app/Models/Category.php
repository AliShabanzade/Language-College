<?php

namespace App\Models;

use App\Actions\Translation\TranslationAction;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use HasTranslationAuto;

    private array $translatable = ['title'];

    protected $fillable = ['published','parent_id', 'slug', 'type'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function parent():BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children():HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function books():HasMany
    {
        return $this->hasMany(Book::class);
    }





}
