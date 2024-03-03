<?php

namespace App\Actions\Order;

use App\Actions\OrderItem\StoreOrderItemAction;
use App\Models\Book;
use App\Models\Order;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderAction
{
    use AsAction;

    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly OrderItemRepositoryInterface $orderItemRepository,

    )
    {
    }

    public function handle(array $payload)
    {
        return DB::transaction(function () use ($payload) {
            $total = 0;
            $book_id = collect($payload['items'])->pluck('book_id');
            $books = Book::whereIn('id', $book_id)->get();

            $items = collect();
            foreach ($payload['items'] as $item) {
                $book = $books->where('id', $item['book_id'])->first();

                $total += $book->price * (int)$item['quantity'];
                $item['price'] = $book->price;
                $items->push($item);
            }

//            if (empty($payload['user_id'])) {
//                $payload['user_id'] = auth()->id();
//            }
            $payload['total'] = $total;
            $payload['user_id'] = Arr::get($payload, 'user_id', auth()->id());
            $order = $this->orderRepository->store($payload);

            $items->each(function ($items) use ($order) {
                $items['order_id'] = $order->id;
            });
            StoreOrderItemAction::run($order, $items->toArray());
            return $order;
        });

    }


}
