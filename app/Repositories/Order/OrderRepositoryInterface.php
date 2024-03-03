<?php

namespace App\Repositories\Order;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Collection;


interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Order;

    public function storeMany(Order $order,array $items):Collection;

}
