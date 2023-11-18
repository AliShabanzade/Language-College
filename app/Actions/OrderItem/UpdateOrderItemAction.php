<?php

namespace App\Actions\OrderItem;

use App\Enums\PermissionEnum;
use App\Models\OrderItem;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateOrderItemAction
{
    use AsAction;

    public function __construct(private readonly OrderItemRepositoryInterface $repository)
    {
    }


    /**
     * @param OrderItem                                          $orderItem
     * @param array{name:string,mobile:string,email:string} $payload
     * @return OrderItem
     */
    public function handle(OrderItem $orderItem, array $payload): OrderItem
    {
        return DB::transaction(function () use ($orderItem, $payload) {
            $orderItem->update($payload);
            return $orderItem;
        });
    }
}
