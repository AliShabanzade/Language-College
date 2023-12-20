<?php

namespace App\Repositories\Cart;

use App\Models\User;
use App\Repositories\BaseRepositoryInterface;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Cart;

    public function getItemsForOrder(int $userId);

    public function clearPaidUserCart(int $userId);

    public function findCartItem(int $userId, int $bookId): ?Cart;

    public function findAnyUserCart(int $userId):bool;

    public function getTotal():int;
}
