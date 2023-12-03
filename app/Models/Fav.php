<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Fav extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslationAuto,InteractsWithMedia;

    protected $fillable = ['x'];
    private array $translatable = ['title', 'summery'];
}
