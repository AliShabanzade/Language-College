<?php

namespace App\Models;

use App\Actions\Translation\TranslationAction;
use App\Traits\HasGetAttribute;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use HasTranslationAuto, HasGetAttribute;

    protected $fillable = ['parent_id', 'published', 'slug', 'type'];


    public function parent():BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function child(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    private array $translatable = ['title'];

    public function setAttribute($key, $value)
    {

        if (in_array($key, $this->translatable)) {

            return TranslationAction::run($this, $value);
        }
        $this->attributes[$key] = $value;
    }


}
