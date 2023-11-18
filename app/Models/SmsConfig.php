<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'username', 'status', 'password'
    ];

    protected $casts = [
        'status' => StatusEnum::class
    ];
}
