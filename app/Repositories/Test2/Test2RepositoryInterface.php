<?php

namespace App\Repositories\Test2;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Test2;

interface Test2RepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Test2;
}
