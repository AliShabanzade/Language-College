<?php

namespace App\Models;


use App\Traits\HasCategory;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasSlug;
use App\Traits\HasUser;
use App\Traits\HasTranslationAuto;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Book extends Model implements HasMedia
{
//    use SchemalessAttributesTrait;
    use HasSchemalessAttributes;
    use InteractsWithMedia,HasFactory, SoftDeletes, HasSlug,
        HasView,
        HasTranslationAuto, HasUser, HasCategory;

    private array $translatable = ['name',  'writer'];
    protected     $fillable     = ['slug', 'user_id', 'category_id', 'inventory', 'published', 'price', 'pages', 'sales','publication_id','extra_attributes'];
    protected     $casts        = [
        'extra_attributes' => 'array',
    ];

    // extra_attributes : ExtraEnum::class


    public function publication():BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items')
                    ->using(OrderItem::class)
                    ->withPivot(['quantity', 'price', 'uuid']);
    }

    public function items():HasMany
    {
        return $this->hasMany(OrderItem::class , 'book_id' , 'id');
    }

    public function carts(): HasMany
    {
        return  $this->hasMany(Cart::class);
    }

}
