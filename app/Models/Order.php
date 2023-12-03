<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasUser, SoftDeletes, HasSlug;

    protected $fillable = ['slug', 'user_id', 'status', 'total'];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'order_items')
                    ->using(OrderItem::class)
                    ->withPivot(['quantity', 'price', 'uuid']);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }


}
