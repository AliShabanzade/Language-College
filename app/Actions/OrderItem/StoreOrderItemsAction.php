<?php

namespace App\Actions\OrderItem;

use App\Models\Book;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderItemsAction
{
    use AsAction;

    public function __construct(private readonly OrderRepositoryInterface $orderRepository)
    {
    }


    public function handle(Order $order, array $items): Collection
    {
        return DB::transaction(function () use ($order, $items) {
            foreach ($items as $item) {
                try {
                    Book::where('id', $item['book_id'])->decrement('inventory', $item['quantity']);
                } catch (\Exception $exception) {
                    abort(400, 'عدم موجودی');
                }
            }
            return $this->orderRepository->storeMany($order, $items);
        });
    }


}
