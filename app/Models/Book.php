<?php

namespace App\Models;


use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use HasFactory,SoftDeletes,HasSlug,HasUser,HasTranslationAuto;
    protected $fillable= ['slug',  'user_id', 'category_id', 'inventory', 'published', 'price', 'pages', 'sales'];

//    public function sluggable()
//    {
//        return [
//            'slug' => [
//                'source' => 'name'
//            ]
//        ];
//    }
    private array $translatable = ['name','publication','writer'];


}
