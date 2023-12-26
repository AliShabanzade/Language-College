<?php

namespace App\Actions\Order;

use App\Actions\OrderItem\StoreOrderItemsAction;
use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderAction
{
    use AsAction;

    public function __construct(
        private readonly OrderRepositoryInterface     $orderRepository,
        private readonly OrderItemRepositoryInterface $orderItemRepository,
        private readonly BookRepositoryInterface      $bookRepository,

    )
    {
    }

    public function handle(array $payload)
    {
        return DB::transaction(function () use ($payload) {
            $total = 0;
            $books_id = collect($payload['items'])->pluck('book_id');
            $books = Book::whereIn('id', $books_id)->get();
            $items = collect();
            foreach ($payload['items'] as $item) { //12
                $book = $books->where('id', $item['book_id'])->first();
                $total += $book->price * (int)$item['quantity'];
                $item['price'] = $book->price;
                $items->push($item);
            }
            $payload['total'] = $total;
            $payload['user_id'] = Arr::get($payload,'user_id',auth()->id());
            $order = $this->orderRepository->store($payload);
            $items->each(function ($item) use ($order) {
                $item['order_id'] = $order->id;
            });
            StoreOrderItemsAction::run($order,$items->toArray());
            return $order;
        });

    }
}
