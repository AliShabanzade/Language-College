<?php

namespace App\Actions\Cart;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
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
        return DB::transaction(function () {
            //1.get user id
            $userId = auth()->user()->id;
            //1.1.check inventory
            $carts = $this->cartRepository->getUserCart($userId);

            Book::findMany($carts->pluck('book_id'))->each(function (Book $book) use ($carts) {
                if ($book->inventory < $carts->where('book_id', $book->id)->first()?->quantity) {
                    abort(400, 'no inventory');
                }
            });
            //2.messure total
            $total = $carts->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            //3.create order
            $order = Order::create([
                'user_id' => $userId,
                'total'   => $total,
            ]);
            //3.convert cart to orderItem
            $carts->each(function (Cart $cart) use ($order) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'quantity' => $cart->quantity,
                    'book_id'  => $cart->book_id,
                    'price'    => $cart->price
                ]);
                Book::where('id', $cart->book_id)->decrement('inventory', $cart->quantity);
                $cart->delete();
            });
            //3.remove cart =>ok
            //3.decrise from book inventory =>ok
            return $order;
        });


//        if (!empty($result)) {
//            return DB::transaction(function () use ($userId) {
//                $orderPayload = ['user_id' => $userId];
//                $order = StoreOrderAction::run($orderPayload);
//                if (!$order) {
//                    return null;
//                }
//                return $order;
//            });
//        } else {
//            return false;
//        }
    }
}
