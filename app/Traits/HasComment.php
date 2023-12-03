<?php

namespace App\Traits;

use App\Models\Comment;

trait  HasComment
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
