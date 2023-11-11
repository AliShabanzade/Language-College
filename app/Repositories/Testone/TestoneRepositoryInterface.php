<?php

namespace App\Repositories\Testone;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Testone;

interface TestoneRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Testone;
}
