<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory,HasUser;
    protected $fillable= [
        'user_id', 'likeable_id', 'likeable_type',
    ];
}
