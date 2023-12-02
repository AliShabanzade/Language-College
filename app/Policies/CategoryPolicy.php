<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

       return $user->hasAnyPermission(PermissionEnum::CATEGORY_ALL->value, PermissionEnum::CATEGORY_STORE->value,PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->hasAnyPermission(PermissionEnum::CATEGORY_ALL->value, PermissionEnum::CATEGORY_UPDATE->value,
                PermissionEnum::ADMIN->value)
            ||$user->id === $category->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->hasAnyPermission(PermissionEnum::CATEGORY_ALL->value, PermissionEnum:: CATEGORY_DELETE->value,PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return $user->hasAnyPermission(PermissionEnum::CATEGORY_ALL->value, PermissionEnum::CATEGORY_RESTORE->value,PermissionEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return $user->hasAnyPermission(PermissionEnum::CATEGORY_ALL->value, PermissionEnum::CATEGORY_INDEX->value,PermissionEnum::ADMIN->value);
    }
}
