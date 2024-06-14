<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Permission;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_INDEX->value, PermissionsEnum::ORDER_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_SHOW->value, PermissionsEnum::ORDER_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_STORE->value, PermissionsEnum::ORDER_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_UPDATE->value, PermissionsEnum::ORDER_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): bool
    {

        return $user->hasAnyPermission(PermissionsEnum::ORDER_DELETE->value, PermissionsEnum::ORDER_ALL->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Order $order): bool
    {

        return $user->hasAnyPermission(PermissionsEnum::ORDER_RESTORE->value, PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ORDER_ALL->value, PermissionsEnum::ADMIN->value);
    }
}
