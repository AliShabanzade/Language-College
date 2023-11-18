<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCartAction
{
    use AsAction;

    public function __construct(public readonly CartRepositoryInterface $repository)
    {
    }

    public function handle(Cart $cart): bool
    {
        return DB::transaction(function () use ($cart) {
            return $this->repository->delete($cart);
        });
    }
}
