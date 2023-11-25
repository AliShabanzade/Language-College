<?php

namespace App\Models;

use App\Traits\HasLike;
use App\Traits\HasMedia;
use App\Traits\HasUser;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasSlug;

class Opinion extends Model
{
    use HasFactory,HasLike,HasMedia,HasView,HasUser,\App\Traits\HasSlug;
    protected $fillable= [
        'slug', 'user_id', 'published', 'body', 'title'
    ];



}
