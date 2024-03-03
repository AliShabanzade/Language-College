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

class UpdateOrderAction
{
    use AsAction;

    public function __construct(
        private readonly OrderRepositoryInterface     $orderRepository,
        private readonly OrderItemRepositoryInterface $orderItemRepository,

    )
    {
    }

    public function handle(Order $order, array $payload)
    {
        return DB::transaction(function () use ($order, $payload) {
            $total = 0;
            $book_id = collect($payload['items'])->pluck('book_id');
            $books = Book::whereIn('id', $book_id)->get();
            $order->items->whereNotIn('book_id', $book_id)->delete;
            foreach ($payload['items'] as $item) {
                $book = $this->orderItemRepository->updateOrCreate(
                    [
                        'order_id' => $order->id,
                        'book_id' => $item['book_id']
                    ],
                    [
                        'quantity' => $item['quantity'],
                        "price" => $books->where('id', $item['book_id'])->first()->price,
                    ]
                );
                $total += $book->price * (int)$item['quantity'];


            }
            $payload['total'] = $total;
            $payload['user_id'] = Arr::get($payload, 'user_id', auth()->id());
            $order = $this->orderRepository->update($order,$payload);

            $items->each(function ($items) use ($order) {
                $items['order_id'] = $order->id;
            });
            StoreOrderItemAction::run($order, $items->toArray());
            return $order;
        });

    }


}
