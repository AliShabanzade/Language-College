<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCartAction
{
    use AsAction;

    public function __construct(
        private readonly CartRepositoryInterface $repository,
        private readonly BookRepositoryInterface $bookRepository
    )
    {
    }

    public function handle(array $payload): ?Cart
    {
        return DB::transaction(function () use ($payload) {
            $bookId = $payload['book_id'];

            return $this->repository->updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'book_id' => $bookId,
                ], [
                'quantity' => $payload['quantity'],
                'price'    => $this->bookRepository->find($bookId, firstOrFail: true)->price,
            ]);
        });
    }
}
