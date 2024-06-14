<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COURSE_ALL->value,
            PermissionsEnum::COURSE_INDEX->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $course): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COURSE_ALL->value,
            PermissionsEnum::COURSE_SHOW->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COURSE_ALL->value,
            PermissionsEnum::COURSE_STORE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Course $course): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COURSE_ALL->value,
                PermissionsEnum::COURSE_UPDATE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Course $course): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COURSE_ALL->value, PermissionsEnum::COURSE_DELETE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Course $course): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COURSE_ALL->value, PermissionsEnum::COURSE_RESTORE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::COURSE_ALL->value, PermissionsEnum::COURSE_STORE->value,PermissionsEnum::ADMIN->value);

    }


}
