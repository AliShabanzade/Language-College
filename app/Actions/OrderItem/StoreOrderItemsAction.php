<?php

namespace App\Actions\OrderItem;

use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderItemsAction
{
    use AsAction;

    public function __construct(private readonly OrderRepositoryInterface $orderRepository)
    {
    }


    public function handle(Order $order, array $payload): Collection
    {

        return DB::transaction(function () use ($order, $payload) {
            return $this->orderRepository->storeMany($order, $payload);
        });
    }


}
