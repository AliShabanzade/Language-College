<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Cart;

    public function getItemsForOrder(int $userId);

    public function clearPaidUserCart(int $userId);

    public function findCartItem(int $userId, int $bookId): ?Cart;

    public function findAnyUserCart(int $userId): bool;

    public function getUserCart(int $userId): Collection;

    public function getTotal(): int;
}
