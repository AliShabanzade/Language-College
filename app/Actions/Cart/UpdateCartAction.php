<?php

namespace App\Actions\Cart;

use App\Enums\PermissionEnum;
use App\Models\Cart;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCartAction
{
    use AsAction;

    public function __construct(private readonly CartRepositoryInterface $repository)
    {
    }

    /**
     * @param Cart  $cart
     * @param array $payload
     * @return Cart
     */
    public function handle(Cart $cart, array $payload): Cart|null
    {
        $userId = auth()->user()->id;
        $user = auth()->user();
        $roles = $user->roles;

        return DB::transaction(function () use ($cart, $payload, $userId, $roles) {
            if ($userId == $cart->user_id || $roles->contains('name', 'admin') || $roles->contains('name')) {
                $payload = array_merge($payload, ['user_id' => $userId]);
                $this->repository->update($cart, $payload);
            }
            return $cart;
        });
    }
}
