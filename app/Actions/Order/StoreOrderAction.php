<?php

namespace App\Actions\Order;

use App\Actions\OrderItem\StoreOrderItemAction;
use App\Models\Order;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderAction
{
    use AsAction;

    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly OrderItemRepositoryInterface $orderItemRepository,

    )
    {
    }

    public function handle(array $payload)
    {
        return DB::transaction(function () use ($payload) {
            $order = $this->orderRepository->store($payload);
//            dd($order);
            StoreOrderItemAction::run($order->toArray());
            $this->orderRepository->update($order, ['payment' => true]);
            $this->updateOrderTotal($order);

            return $order;
        });

    }


    private function updateOrderTotal(Order $order): void
    {
        $orderItems = $this->orderItemRepository->getItemsForOrder($order->id);
        $orderTotal = 0;
        foreach ($orderItems as $orderItem) {
            $totalItemCost = $orderItem->price * $orderItem->quantity;
            $orderTotal += $totalItemCost;
        }
        $order->total = $orderTotal;
        $order->save();
    }


}
