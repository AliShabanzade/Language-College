<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Fav extends Model
{
    use HasFactory;
    use HasTranslationAuto,InteractsWithMedia;

    protected $fillable = ['x'];
    private array $translatable = ['title', 'summery'];
}
