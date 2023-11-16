<?php

namespace App\Repositories\OrderItem;

use App\Repositories\BaseRepositoryInterface;
use App\Models\OrderItem;

interface OrderItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): OrderItem;
}
