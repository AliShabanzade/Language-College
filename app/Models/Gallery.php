<?php

namespace App\Models;

use App\Traits\HasComment;
use App\Traits\HasLike;
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
    use HasUser;
//    use HasCategory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description'
    ];


    /**
     * @throws InvalidManipulationAlias
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
             ->width((int)null)
             ->height((int)null);
    }
}
