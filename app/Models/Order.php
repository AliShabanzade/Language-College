<?php

namespace App\Models;

use App\Traits\HasSchemalessAttributes;
use App\Traits\HasSlug;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasUser, SoftDeletes, HasSchemalessAttributes;

    protected $fillable = ['user_id', 'status', 'total', 'extra_attributes'];

    protected $casts = [
        'extra_attributes' => 'array' //OrderExtraEnum
    ];



    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }


}
