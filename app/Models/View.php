<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class View extends Model
{
    use HasFactory, HasUser;

    protected $fillable = [
        'user_id', 'viewable_id', 'viewable_type', 'ip',
    ];

    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
