<?php

namespace App\Models;

use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasUser;
use App\Traits\HasView;
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
    use HasFactory;
    use HasUser;
    use SoftDeletes;
    use HasComment;
    use HasLike;
    use HasView;

//    use HasTag;
//    use HasCategory;


    protected $fillable = [
        //        'category_id',
        'user_id',
        'title',
        'description',
        'published',
    ];


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

}
