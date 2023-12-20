<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory, HasUser;

    protected $fillable = ['user_id', 'book_id', 'quantity','price'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

}
