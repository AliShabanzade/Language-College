<?php

namespace App\Models;


use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Fav extends Model
{
    use HasFactory;
    use HasUser;


    protected $fillable = [
        'user_id',
        'favable_id',
        'favable_type',
    ];

    public function favable(): MorphTo
    {
        return $this->morphTo();
    }
}
