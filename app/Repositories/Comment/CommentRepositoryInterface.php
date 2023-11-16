<?php

namespace App\Repositories\Comment;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Comment;

interface CommentRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Comment;
}
