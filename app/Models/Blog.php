<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Blog extends Model implements HasMedia
{
    use HasFactory,
        SoftDeletes,
        HasUser,
        InteractsWithMedia,
        HasSchemalessAttributes,
        HasLike,
        HasView,
        HasComment,
        HasTranslationAuto,
        HasCategory;

    protected $fillable = [
        'user_id',
        'category_id',
        'published',
        'reading_time',
        'extra_attributes',
    ];

    private $translatable = [
        'title',
        'description',
        'slug',
    ];

    protected $casts = [
        'extra_attributes' => 'array',
    ];

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('blog')
             ->singleFile()
            ->registerMediaConversions(
                function (Media $media){
                    $this->addMediaConversion('1200-760')->width(1200)->height(760);
                    $this->addMediaConversion('200-200')->width(200)->height(200);
                });
    }

}
