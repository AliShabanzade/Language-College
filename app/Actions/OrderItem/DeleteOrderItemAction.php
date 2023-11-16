<?php

namespace App\Actions\OrderItem;

use App\Models\OrderItem;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteOrderItemAction
{
    use AsAction;

    public function __construct(public readonly OrderItemRepositoryInterface $repository)
    {
    }

    public function handle(OrderItem $orderItem): bool
    {
        return DB::transaction(function () use ($orderItem) {
            return $this->repository->delete($orderItem);
        });
    }
}
