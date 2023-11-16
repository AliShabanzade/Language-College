<?php

namespace App\Repositories\Like;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Like;

interface LikeRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Like;
}
