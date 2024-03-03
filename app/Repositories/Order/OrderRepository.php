<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Order
   {
       return parent::getModel();
   }


    public function storeMany(Order $order, array $items): Collection
    {
        return $order->items()->createMany($items);
    }
}
