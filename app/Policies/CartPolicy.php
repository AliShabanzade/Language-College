<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Cart;
use App\Models\User;

class CartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::CART_ALL->value, PermissionEnum::CART_INDEX->value,
            PermissionEnum::ADMIN->value);
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cart $cart): bool
    {
        return $user->id == $cart->user_id || $user->hasAnyPermission(PermissionEnum::USER_ALL->value, PermissionEnum::USER_SHOW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::CART_STORE->value, PermissionEnum::CART_ALL->value,
            PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cart $cart): bool
    {
        return $user->hasAnyPermission(PermissionEnum::CART_UPDATE->value, PermissionEnum::CART_UPDATE->value,
            PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cart $cart): bool
    {
        return $user->hasAnyPermission(PermissionEnum::CART_DELETE->value, PermissionEnum::CART_ALL->value,
            PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cart $cart): bool
    {
        return $user->hasAnyPermission(PermissionEnum::USER_RESTORE->value, PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cart $cart): bool
    {
        return $user->hasAnyPermission(PermissionEnum::USER_ALL->value, PermissionEnum::ADMIN->value);
    }

    public function checkout(User $user): bool
    {
        return true;
    }
}
