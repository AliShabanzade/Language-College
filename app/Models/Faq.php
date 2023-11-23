<?php

namespace App\Models;


use App\Traits\HasCategory;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Faq extends Model
{
    use HasFactory, SoftDeletes, HasCategory, HasSlug;

    protected $fillable = ['category_id', 'slug', 'question', 'answer', 'published'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }


}
