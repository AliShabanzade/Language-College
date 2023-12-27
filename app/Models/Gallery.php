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

class Gallery extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasView;
    use HasLike;
    use HasComment;
    use HasUser;
    use HasCategory;
    use HasTranslationAuto;
    use HasSchemalessAttributes;
    use HasSlug;



    protected $casts = [
        'extra_attributes' => 'array',
    ];

    protected $fillable = [
        'slug',
        'user_id',
        'category_id',
        'published',
        'extra_attributes',

    ];

    // extra_attributes : ExtraEnum::class


    protected  array $translatable = ['title', 'description'];

    /**
     * @throws InvalidManipulationAlias
     */
//    public function registerMediaCollections(Media $media = null): void
//    {
//       $this->addMediaCollection('media')
//           ->singleFile()
//           ->registerMediaConversions(fa);
//    }
}
