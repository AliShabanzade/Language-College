<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Classroom;
use App\Models\User;

class ClassroomPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CLASSROOM_ALL->value,
            PermissionsEnum::CLASSROOM_DELETE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Classroom $classroom): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CLASSROOM_ALL->value,
            PermissionsEnum::CLASSROOM_SHOW->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CLASSROOM_ALL->value,
            PermissionsEnum::CLASSROOM_STORE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Classroom $classroom): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CLASSROOM_ALL->value,
                PermissionsEnum::CLASSROOM_UPDATE->value,PermissionsEnum::ADMIN->value)
            || $user->id === $classroom->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Classroom $classroom): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CLASSROOM_ALL->value,
            PermissionsEnum::CLASSROOM_DELETE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Classroom $classroom): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CLASSROOM_ALL->value,
            PermissionsEnum::CLASSROOM_STORE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
//    public function forceDelete(User $user, Classroom $classroom): bool
//    {
//        //
//    }

    public function addMember(User $user)
    {
        return $user->hasAnyPermission(PermissionsEnum::CLASSROOM_ALL->value,
            PermissionsEnum::ADMIN->value);
    }
}
