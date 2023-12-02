<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\HasComment;
use App\Traits\HasLike;
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
//    use HasTranslation;
//    use HasTag;


    protected $fillable = [
        'category_id',
        'user_id',
        'published',
    ];

    protected array $translatable = ['title', 'description'];

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
             ->width((int)null)
             ->height((int)null);
    }

    public function scopeSearch(Builder $query,string $data)
    {
        return $query->when(function (Builder $q) use ($data) {

//            $q->where($this->translations()->whereKey('title'), 'like', '%' . $data . '%');
//                ->orWhere($this->translations()->value('value'), 'like', '%' . $data . '%');
        });
    }
}
