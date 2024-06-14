<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Department;
use App\Models\Session;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::USER_INDEX->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::USER_SHOW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::USER_STORE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::USER_UPDATE->value) ||
            $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::USER_DELETE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_RESTORE->value, PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::ADMIN->value);
    }
    public function toggle(User $user): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value,PermissionsEnum::USER_ALL->value,PermissionsEnum::USER_TOGGLE->value]);
    }

}
