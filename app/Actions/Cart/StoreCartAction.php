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

    public function handle(array $payload): Cart
    {
        return DB::transaction(function () use ($payload) {
            $userId = auth()->user()->id;
            $bookId = $payload['book_id'];
            $quantity = $payload['quantity'] ?? 1;
            $existingCartItem = $this->repository->findCartItem($userId, $bookId);
            if ($existingCartItem) {
                $existingCartItem->update(['quantity' => $existingCartItem->quantity + $quantity]);
                return $existingCartItem;
            }
            $book = $this->bookRepository->find($bookId);
            if ($book) {
                $payload['user_id'] = $userId;
                return $this->repository->store($payload);
            }
            return null;
        });
    }
}
