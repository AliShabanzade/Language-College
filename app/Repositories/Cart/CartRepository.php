<?php

namespace App\Repositories\Cart;

use App\Enums\OrderStatusEnum;
use App\Models\Cart;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function userOwnCart($user)
    {
        $result = [];

        if ($user) {
            $carts = parent::query()
                           ->where('user_id', $user->id)
                           ->with('book')
                           ->get();

            foreach ($carts as $cart) {
                $result[] = [
                    'cart_id' => $cart->id,
                    'book_id' => $cart->product->id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                    'total_price' => $cart->quantity * $cart->product->price,
                ];
            }
        }
        $totalPrice = collect($result)->sum('total_price');
        return [
            'carts' => $result,
            'total_price' => $totalPrice,
        ];
    }


    public function getItemsForOrder(int $userId)
    {
        $res =parent::query()->where('user_id', $userId)->get();
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
        $model=parent::query()->where('user_id', $userId)
                   ->where('book_id', $bookId)
                   ->first();
        return $model;
    }


    public function findAnyUserCart(int $userId): bool
    {

        $result = parent::query()->where('user_id' , $userId)->first();
        if (!empty($result)){
            return true;
        }else{
            return false;
        }
    }
}
