<?php

namespace App\Repositories\Cart;

use App\Enums\OrderStatusEnum;
use App\Enums\RoleEnum;
use App\Models\Cart;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Cart
    {
        return parent::getModel();
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return Cart::with('book')
                   ->when(auth()->user()->hasRole(RoleEnum::ADMIN->value),
                       function (Builder $query) {
                       $query->with('user');
                   })
                   ->when(!auth()->user()->hasRole(RoleEnum::ADMIN->value),
                       function (Builder $query) {
                       $query->where('user_id', auth()->user()->id);
                   });
    }

    public function getItemsForOrder(int $userId)
    {
        $res = parent::query()->where('user_id', $userId)->get();
        return $res;

    }


    public function clearPaidUserCart(int $userId)
    {
        $user = User::find($userId);
        if ($user) {
            foreach ($user->orders as $order) {
                if ($order['status'] == OrderStatusEnum::PAID->value) {
                    $user->carts()->delete();
                }
            }
        }
    }

    public function findCartItem(int $userId, int $bookId): ?Cart
    {
        /** @var Cart $model */
        $model = parent::query()->where('user_id', $userId)
                       ->where('book_id', $bookId)
                       ->first();
        return $model;
    }


    public function findAnyUserCart(int $userId): bool
    {

        $result = parent::query()->where('user_id', $userId)->first();
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function getTotal(): int
    {
      return $this->query()->sum(DB::raw('price * quantity'));
    }

}
