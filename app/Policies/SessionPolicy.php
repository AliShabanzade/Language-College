<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Session;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::SESSION_ALL->value,
            PermissionsEnum::SESSION_INDEX->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Session $session): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::SESSION_ALL->value,
            PermissionsEnum::SESSION_SHOW->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::SESSION_ALL->value,
            PermissionsEnum::SESSION_STORE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Session $session): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::SESSION_ALL->value,
                PermissionsEnum::SESSION_UPDATE->value,PermissionsEnum::ADMIN->value)
            || $user->id === $session->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Session $session): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::SESSION_ALL->value,
            PermissionsEnum::SESSION_DELETE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Session $session): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Session $session): bool
    {
        //
    }
    public function toggle(User $user,Session $session): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value,PermissionsEnum::USER_ALL->value,PermissionsEnum::USER_TOGGLE->value]);
    }
}
