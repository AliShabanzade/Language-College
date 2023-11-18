<?php

namespace App\Actions\Order;

use App\Enums\PermissionEnum;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateOrderAction
{
    use AsAction;

    public function __construct(private readonly OrderRepositoryInterface $repository)
    {
    }


    /**
     * @param Order                                          $order
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Order
     */
    public function handle(Order $order, array $payload): Order
    {
        return DB::transaction(function () use ($order, $payload) {
            $order->update($payload);
            return $order;
        });
    }
}
