<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCartAction
{
    use AsAction;

    public function __construct(private readonly CartRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Cart
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
