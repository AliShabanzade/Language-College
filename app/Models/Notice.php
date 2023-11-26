<?php

namespace App\Models;

use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasView;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Notice extends Model
{
    use HasFactory;
    use HasUser;
    use HasComment;
    use HasLike;
    use HasView;


    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'published',
    ];

}
