<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
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
        return $user->hasAnyPermission([PermissionsEnum::ROLE_ALL->value, PermissionsEnum::ROLE_INDEX->value, PermissionsEnum::ADMIN->value]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ROLE_ALL->value, PermissionsEnum::ROLE_SHOW->value,PermissionsEnum::ADMIN->value);


    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ROLE_ALL->value, PermissionsEnum::ROLE_STORE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {

        return $user->hasAnyPermission(PermissionsEnum::ROLE_ALL->value,
            PermissionsEnum::ROLE_UPDATE->value,PermissionsEnum::ADMIN->value)
            ||$user->id === $role->user_id
            ;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ROLE_ALL->value, PermissionsEnum::ROLE_DELETE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ROLE_ALL->value, PermissionsEnum::ROLE_RESTORE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ROLE_ALL->value, PermissionsEnum::ADMIN->value);

    }

    public function addRole(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ROLE_ALL->value, PermissionsEnum::ADMIN->value);
    }

    public function removeRole($user)
    {
        return $user->hasAnyPermission(PermissionsEnum::ROLE_ALL->value, PermissionsEnum::ADMIN->value);

    }

}
