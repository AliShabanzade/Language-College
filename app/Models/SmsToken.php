<?php

namespace App\Models;

use App\Traits\HasUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsToken extends Model
{

    use HasFactory , HasUser ;
    const EXPIRATION_TIME = 2; // minutes
    protected $fillable = ['user_id', 'code', 'used','secret_code'];

    public function isValid()
    {
        return ! $this->isUsed() && ! $this->isExpired();
    }

    public function isUsed()
    {
        return $this->used;
    }

    public function isExpired()
    {
        return $this->created_at->diffInMinutes(Carbon::now()) > static::EXPIRATION_TIME;
    }
}
