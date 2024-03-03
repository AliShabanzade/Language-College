<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Exceptions\InvalidManipulation as InvalidManipulationAlias;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasView;
    use HasLike;
    use HasComment;
    use HasUser,HasSlug;
    use HasCategory;
    use HasTranslationAuto;
    use HasSchemalessAttributes;

    protected $casts = [
        'extra_attributes' => 'array',
    ];

    protected $fillable = ['slug', 'user_id', 'category_id', 'published', 'extra_attributes'];

    // extra_attributes : ExtraEnum::class


    protected array $translatable = ['title', 'description'];

    /**
     * @throws InvalidManipulationAlias
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->performOnCollections('gallery')
            ->width(100)
            ->height(100);

        $this->addMediaConversion('480')
            ->width(480)
            ->height(480);

        $this->addMediaConversion('1080')
            ->width(1080)
            ->height(1080);
    }
}
