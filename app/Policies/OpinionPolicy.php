<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Opinion;
use App\Models\User;

class OpinionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::OPINION_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Opinion $opinion): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::OPINION_ALL->value, PermissionsEnum::OPINION_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::USER_ALL->value, PermissionsEnum::OPINION_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Opinion $opinion): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::OPINION_ALL->value, PermissionsEnum::OPINION_UPDATE->value) || $user->id === $opinion->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Opinion $opinion): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::OPINION_ALL->value, PermissionsEnum::OPINION_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Opinion $opinion): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::OPINION_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Opinion $opinion): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value);

    }
}
