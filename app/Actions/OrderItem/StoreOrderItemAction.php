<?php

namespace App\Actions\OrderItem;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderItemAction
{
    use AsAction;

    public function __construct(private readonly OrderItemRepositoryInterface $orderItemRepository,
        private readonly CartRepositoryInterface $cartRepository ,
        private readonly BookRepositoryInterface $bookRepository)
    {
    }


    public function handle(array $payload)
    {

        return DB::transaction(function () use ($payload) {
            $this->orderItemRepository->store($payload);
            return true;
        });
    }


}
