<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
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
        return $user->hasAnyPermission(PermissionEnum::ORDER_ITEM_INDEX->value, PermissionEnum::ORDER_ITEM_ALL->value,
            PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ORDER_ITEM_SHOW->value, PermissionEnum::ORDER_ITEM_ALL->value,
            PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ORDER_ITEM_STORE->value, PermissionEnum::ORDER_ITEM_ALL->value,
            PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ORDER_ITEM_UPDATE->value, PermissionEnum::ORDER_ITEM_ALL->value,
            PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ORDER_ITEM_DELETE->value, PermissionEnum::ORDER_ITEM_ALL->value,
            PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ORDER_ITEM_RESTORE->value, PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OrderItem $orderItem): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ORDER_ITEM_ALL->value, PermissionEnum::ADMIN->value);

    }
}
