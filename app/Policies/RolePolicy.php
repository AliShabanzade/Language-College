<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission([PermissionEnum::ROLE_ALL->value, PermissionEnum::ROLE_INDEX->value,PermissionEnum::ADMIN->value]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ROLE_ALL->value, PermissionEnum::ROLE_SHOW->value,PermissionEnum::ADMIN->value);


    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ROLE_ALL->value, PermissionEnum::ROLE_STORE->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {

        return $user->hasAnyPermission(PermissionEnum::ROLE_ALL->value,
            PermissionEnum::ROLE_UPDATE->value,PermissionEnum::ADMIN->value)
            ||$user->id === $role->user_id
            ;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ROLE_ALL->value, PermissionEnum::ROLE_DELETE->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ROLE_ALL->value, PermissionEnum::ROLE_RESTORE->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ROLE_ALL->value, PermissionEnum::ADMIN->value);

    }

    public function addRole(User $user)
    {

        if ($user->hasPermissionTo( PermissionEnum::ADMIN->value)) {

            return true;
        }
    }

    public function removeRole($user)
    {
        if ($user->hasPermissionTo(PermissionEnum::ADMIN->value)) {
            return true;
        }
    }

}
