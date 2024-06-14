<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_ITEM_INDEX->value, PermissionsEnum::ORDER_ITEM_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_ITEM_SHOW->value, PermissionsEnum::ORDER_ITEM_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_ITEM_STORE->value, PermissionsEnum::ORDER_ITEM_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_ITEM_UPDATE->value, PermissionsEnum::ORDER_ITEM_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_ITEM_DELETE->value, PermissionsEnum::ORDER_ITEM_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_ITEM_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_ITEM_ALL->value, PermissionsEnum::ADMIN->value);

    }
}
