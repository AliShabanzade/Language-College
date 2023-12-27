<?php

namespace App\Actions\Order;

use App\Models\Book;
use App\Models\Order;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;


class UpdateOrderAction
{
    use AsAction;

    public function __construct(private readonly OrderRepositoryInterface     $orderRepository,
                                private readonly OrderItemRepositoryInterface $orderItemRepository,
                                private readonly BookRepositoryInterface      $bookRepository,)
    {
    }


    /**
     * @param Order $order
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Order
     */
    public function handle(Order $order, array $payload): Order
    {
        return DB::transaction(function () use ($order, $payload) {
            //1:get all data
            //2:get deference data and delete them
            //3:update or create new record
            //4:total
            //5:update order
            //6:generate event
            $total = 0;
            $books_id = collect($payload['items'])->pluck('book_id');
            $books = Book::whereIn('id', $books_id)->get();
            $order->items()->whereNotIn('book_id', $books_id)->delete();
            //add or update record
            foreach ($payload['items'] as $item) { //12
                $book = $this->orderItemRepository->updateOrCreate(
                    [
                        'order_id' => $order->id,
                        'book_id' => $item['book_id']
                    ],
                    [
                        'quantity' => $item['quantity'],
                        "price" => $books->where("id", $item["book_id"])->first()->price
                    ]);
                $total += $book->price * (int)$item['quantity'];
            }
            $payload['total'] = $total;
            $payload['user_id'] = Arr::get($payload, 'user_id', auth()->id());
            return $this->orderRepository->update($order, $payload);
        });
    }
}
