<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasTranslation;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

//use App\Traits\HasMedia;


class Notice extends Model implements HasMedia

{
    use InteractsWithMedia;
    use HasCategory;
    use SoftDeletes;
    use HasComment;
    use HasFactory;
    use HasUser;
    use HasLike;
    use HasView;
    use HasTranslationAuto;
    use HasSchemalessAttributes;
//    use HasTranslation;
//    use HasTag;


    protected $fillable = [
//        'slug',
        'category_id',
        'user_id',
        'published',
        'extra_attributes',
    ];
    protected $casts = [
        'extra_attributes' => 'array',
    ];

    // extra_attributes : ExtraEnum::class

    protected array $translatable = ['title', 'description'];

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('media')
        ->singleFile()
            ->registerMediaConversions(
              function (Media $media){
               $this->addMediaConversion('100_100')
                    ->crop(Manipulations::CROP_CENTER,100,100,);
               $this->addMediaConversion(480_480)
                   ->crop(Manipulations::CROP_CENTER, 480  , 480,);
              });

    }

    public function scopeSearch(Builder $query,string $data)
    {
        return $query->when(function (Builder $q) use ($data) {

//            $q->where($this->translations()->whereKey('title'), 'like', '%' . $data . '%');
//                ->orWhere($this->translations()->value('value'), 'like', '%' . $data . '%');
        });
    }
}
