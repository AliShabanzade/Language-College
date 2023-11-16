<?php

namespace App\Actions\Cart;

use App\Enums\PermissionEnum;
use App\Models\Cart;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCartAction
{
    use AsAction;

    public function __construct(private readonly CartRepositoryInterface $repository)
    {
    }


    /**
     * @param Cart                                          $cart
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Cart
     */
    public function handle(Cart $cart, array $payload): Cart
    {
        return DB::transaction(function () use ($cart, $payload) {
            $cart->update($payload);
            return $cart;
        });
    }
}
