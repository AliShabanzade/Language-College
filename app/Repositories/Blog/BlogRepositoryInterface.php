<?php

namespace App\Repositories\Blog;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Blog;

interface BlogRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Blog;
}
