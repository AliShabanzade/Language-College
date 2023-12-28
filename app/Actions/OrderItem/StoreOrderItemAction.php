<?php

namespace App\Actions\OrderItem;

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
            $cartItems = $this->cartRepository->getItemsForOrder($payload['user_id']);
            foreach ($cartItems as $cartItem) {
                $orderItemPayload = [
                        'order_id' => $payload['id'],
                        'book_id'  => $cartItem->book_id,
                        'quantity' => $cartItem->quantity,
                        'price'    => $cartItem->book->price,
                    ];

                    $this->orderItemRepository->store($orderItemPayload);

                    $this->cartRepository->clearPaidUserCart($payload['user_id']);
                    $bookId =$cartItem->book_id;
                    $quantity =$cartItem->quantity;
                    $this->bookRepository->subtractBookInventory($bookId , $quantity);

            }
            return true;
        });
    }


}
