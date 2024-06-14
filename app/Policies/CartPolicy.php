<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CART_ALL->value, PermissionsEnum::CART_INDEX->value,
            PermissionsEnum::ADMIN->value);
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cart $cart): bool
    {
        return $user->id == $cart->user_id || $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::USER_SHOW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CART_STORE->value, PermissionsEnum::CART_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cart $cart): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CART_UPDATE->value, PermissionsEnum::CART_UPDATE->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cart $cart): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CART_DELETE->value, PermissionsEnum::CART_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cart $cart): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_RESTORE->value, PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cart $cart): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::ADMIN->value);
    }
}
