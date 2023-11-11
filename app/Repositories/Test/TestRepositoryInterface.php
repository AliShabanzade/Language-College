<?php

namespace App\Repositories\Test;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Test;

interface TestRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Test;
}
