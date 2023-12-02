<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class OrderItem extends pivot
{
    use HasFactory , HasUuid , SoftDeletes;

    protected $table = 'order_items';

    protected $fillable = [ 'book_id', 'order_id', 'quantity', 'price'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
