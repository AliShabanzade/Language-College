<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

       return $user->hasAnyPermission(PermissionsEnum::CATEGORY_ALL->value, PermissionsEnum::CATEGORY_STORE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CATEGORY_ALL->value, PermissionsEnum::CATEGORY_UPDATE->value,
                PermissionsEnum::ADMIN->value)
            ||$user->id === $category->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CATEGORY_ALL->value, PermissionsEnum:: CATEGORY_DELETE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CATEGORY_ALL->value, PermissionsEnum::CATEGORY_RESTORE->value,PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::CATEGORY_ALL->value, PermissionsEnum::CATEGORY_INDEX->value,PermissionsEnum::ADMIN->value);
    }
}
