<?php

namespace App\Models;


use App\Traits\HasCategory;
use App\Traits\HasLike;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasSlug;
use App\Traits\HasUser;
use App\Traits\HasTranslationAuto;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Book extends Model implements HasMedia
{

    use HasSchemalessAttributes;
    use InteractsWithMedia,HasFactory, SoftDeletes, HasSlug,
        HasView,HasLike,HasTranslationAuto, HasUser, HasCategory;

    private array $translatable = ['name',  'writer'];
    protected     $fillable     = ['slug', 'user_id', 'category_id', 'inventory', 'published', 'price', 'pages', 'sales','publication_id','extra_attributes'];
    protected     $casts        = [
        'extra_attributes' => 'array',
    ];
    public function registerMediaCollections(Media $media = null): void
    {

        $this->addMediaCollection('media')
            ->singleFile()
            ->registerMediaConversions(
                function (Media $media) {
                    $this->addMediaConversion('100_100')->crop(Manipulations::CROP_CENTER, 400, 400);
                    $this->addMediaConversion('200_200')->crop(Manipulations::CROP_BOTTOM_LEFT, 400, 400);
                    $this->addMediaConversion('512_512')->crop(Manipulations::CROP_TOP, 400, 400);
                });

    }
    public function scopeWithRelations(Builder $query, ...$relations): Builder
    {
        return $query->with($relations);
    }
    public function publication():BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }


//    public function orders(): BelongsToMany
//    {
//        return $this->belongsToMany(Order::class, 'order_items')
//                    ->using(OrderItem::class)
//                    ->withPivot(['quantity', 'price', 'uuid']);
//    }

    public function items():HasMany
    {
        return $this->hasMany(OrderItem::class , 'book_id' , 'id');
    }

    public function carts(): HasMany
    {
        return  $this->hasMany(Cart::class);
    }

}
