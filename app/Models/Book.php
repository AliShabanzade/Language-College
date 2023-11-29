<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUser;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use HasFactory, SoftDeletes, HasSlug, HasUser;

    protected $fillable = ['name', 'publication', 'user_id', 'category_id', 'inventory', 'published',
                           'price', 'pages', 'sales', 'writer'];

//    public function sluggable()
//    {
//        return [
//            'slug' => [
//                'source' => 'name'
//            ]
//        ];
//    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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
