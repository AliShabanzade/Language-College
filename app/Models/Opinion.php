<?php

namespace App\Models;

use App\Traits\HasLike;
use App\Traits\HasMedia;
use App\Traits\HasUser;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Tags\HasSlug;

class Opinion extends Model
{
    use HasFactory,HasLike,HasMedia,HasView,HasUser;
    protected $fillable= [
         'user_id', 'published', 'body', 'title'
    ];

    public function user(): BelongsTo
    {
     return $this->belongsTo(User::class);
}

}
