<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
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
        return parent::getModel(); // TODO: Change the autogenerated stub
    }
// Assuming your Cart model has a relationship with the Product (Book) model
// and the Cart model has a 'price' field that represents the price of the product

    public function userOwnCart($user)
    {
        $result = [];

        if ($user) {
            $carts = parent::query()
                           ->where('user_id', $user->id)
                           ->where('payment', false)
                           ->with('product')
                           ->get();

            foreach ($carts as $cart) {
                $result[] = [
                    'cart_id' => $cart->id,
                    'product_id' => $cart->product->id,
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



}
