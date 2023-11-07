<?php

namespace App\Models;

use App\Traits\HasUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{

    use HasFactory , HasUser ;
//    const EXPIRATION_TIME = 100; // minutes
    protected $fillable = ['user_id', 'code', 'used', 'expire_at'];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('used',false)->where('expire_at', '>', Carbon::now());
    }
}
