<?php

namespace App\Repositories\OrderItem;

use App\Repositories\BaseRepositoryInterface;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

interface OrderItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): OrderItem;

    public function getItemsForOrder(int $orderId);

    public function storeMany(array $items):Collection;
}
