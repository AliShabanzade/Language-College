<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return Order::query()
            ->with(['user'])
            ->when(false, function (Builder $query) {
                $query->where('user_id', auth()->id());
            });
    }

    public function storeMany(Order $order, array $items): Collection
    {
        return $order->items()->createMany($items);
    }
}
