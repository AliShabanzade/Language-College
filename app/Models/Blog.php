<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory,
        SoftDeletes,
        HasUser,
        InteractsWithMedia,
        HasLike,
        HasView,
        HasComment,
        HasTranslationAuto,
        HasCategory;

    protected $fillable = [
        'user_id',
        'category_id',
        'published',
        'reading_time',
    ];

    private $translatable = [
        'title',
        'description'
    ];




}
