<?php

namespace App\Actions\OrderItem;

use App\Models\OrderItem;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderItemAction
{
    use AsAction;

    public function __construct(private readonly OrderItemRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): OrderItem
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
