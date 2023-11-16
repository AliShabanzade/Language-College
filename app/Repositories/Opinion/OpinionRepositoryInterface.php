<?php

namespace App\Repositories\Opinion;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Opinion;

interface OpinionRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Opinion;
}
