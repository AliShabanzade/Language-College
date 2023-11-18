<?php

namespace App\Repositories\Category;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Category;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Category;
}
