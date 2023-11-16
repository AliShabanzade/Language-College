<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderAction
{
    use AsAction;

    public function __construct(private readonly OrderRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Order
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
