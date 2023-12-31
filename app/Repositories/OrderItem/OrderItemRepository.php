<?php

namespace App\Repositories\OrderItem;

use App\Models\OrderItem;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface
{
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

   public function getModel(): OrderItem
   {
       return parent::getModel();
   }

    public function getItemsForOrder(int $orderId)
    {
        return parent::query()->where('order_id', $orderId)->get();
    }

    public function storeMany(array $items): Collection
    {
        return OrderItem::createMany($items);
    }
}
