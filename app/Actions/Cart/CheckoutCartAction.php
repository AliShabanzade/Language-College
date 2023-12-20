<?php

namespace App\Actions\Cart;

use App\Actions\Order\StoreOrderAction;
use App\Actions\OrderItem\StoreOrderItemAction;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckoutCartAction
{
    use AsAction;

    public function __construct(
        private readonly CartRepositoryInterface $cartRepository,
        private readonly OrderItemRepositoryInterface $orderItemRepository,

    )
    {
    }

//    public function handle(array $payload)
    public function handle()
    {
        $user = auth()->user();
        $userId = $user->id;
        $result = $this->cartRepository->findAnyUserCart($userId);
        if (!empty($result)) {
            return DB::transaction(function () use ($user, $userId) {
                $orderPayload = ['user_id' => $userId];

                $order = StoreOrderAction::run($orderPayload);


                if (!$order) {
                    return null;
                }
                return $order;
            });
        } else {
            return false;
        }
    }
}
