<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory,HasUuid;
    protected $fillable=[
        'uuid',
        'mediaable_id',
        'mediaable_type',
        'url',
        'extension',
        'size',
    ];
    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }
}
