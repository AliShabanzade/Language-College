<?php

namespace App\Models;

use App\Traits\HasUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{

    use HasFactory , HasUser ;
//    const EXPIRATION_TIME = 100; // minutes
    protected $fillable = ['user_id', 'code', 'used', 'verify_at'];

    public function isValid()
    {
        return ! $this->isUsed() ;
    }

    public function isUsed()
    {
        return $this->used;
    }

//    public function isExpired()
//    {
//        return $this->created_at->diffInMinutes(Carbon::now()) > static::EXPIRATION_TIME;
//    }
}
