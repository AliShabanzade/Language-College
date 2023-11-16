<?php

namespace App\Repositories\Fav;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Fav;

interface FavRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Fav;
}
