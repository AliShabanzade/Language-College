<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\College;
use App\Models\User;


class CollegePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value,
            PermissionsEnum::COLLEGE_INDEX->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value,
            PermissionsEnum::COLLEGE_SHOW->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value,
            PermissionsEnum::COLLEGE_STORE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value,
                PermissionsEnum::COLLEGE_UPDATE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value, PermissionsEnum::COLLEGE_DELETE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value, PermissionsEnum::COLLEGE_RESTORE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value, PermissionsEnum::COLLEGE_STORE->value,PermissionsEnum::ADMIN->value);

    }

    public function addCourse(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value, PermissionsEnum::ADMIN->value);
    }

    public function toggle(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COLLEGE_ALL->value, PermissionsEnum::ADMIN->value);

    }
}
