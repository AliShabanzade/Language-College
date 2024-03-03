<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\College;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CollegePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::COLLEGE_ALL->value,
            PermissionEnum::COLLEGE_INDEX->value,PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionEnum::COLLEGE_ALL->value,
            PermissionEnum::COLLEGE_SHOW->value,PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::COLLEGE_ALL->value,
            PermissionEnum::COLLEGE_STORE->value,PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionEnum::COLLEGE_ALL->value,
                PermissionEnum::COLLEGE_UPDATE->value,PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionEnum::COLLEGE_ALL->value, PermissionEnum::COLLEGE_DELETE->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionEnum::COLLEGE_ALL->value, PermissionEnum::COLLEGE_RESTORE->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, College $college): bool
    {
        return $user->hasAnyPermission(PermissionEnum::COLLEGE_ALL->value, PermissionEnum::COLLEGE_STORE->value,PermissionEnum::ADMIN->value);

    }
}
