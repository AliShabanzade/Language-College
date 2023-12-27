<?php

namespace App\Actions\Order;

use App\Models\Book;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteOrderAction
{
    use AsAction;

    public function __construct(public readonly OrderRepositoryInterface $repository)
    {
    }

    public function handle(Order $order): bool
    {
        return DB::transaction(function () use ($order) {
            foreach ($order->items as $item) {
                Book::where('id', $item->book_id)->increment('inventory', $item->quantity);
            }
            return $this->repository->delete($order);
        });
    }
}
