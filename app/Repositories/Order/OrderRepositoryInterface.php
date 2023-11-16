<?php

namespace App\Repositories\Order;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Order;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Order;
}
