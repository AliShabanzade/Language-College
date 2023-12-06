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

    public function scopeSearch(Builder $query,string $data)
    {
        return $query->when(function (Builder $q) use ($data) {

//            $q->where($this->translations()->whereKey('title'), 'like', '%' . $data . '%');
//                ->orWhere($this->translations()->value('value'), 'like', '%' . $data . '%');
        });
    }
}
