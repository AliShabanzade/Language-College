<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::BLOG_ALL->value,
            PermissionsEnum::BLOG_INDEX->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Blog $blog): bool
    {
        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::BLOG_ALL->value,
            PermissionsEnum::BLOG_SHOW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::BLOG_ALL->value,
            PermissionsEnum::BLOG_STORE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Blog $blog): bool
    {
        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::BLOG_ALL->value,
            PermissionsEnum::BLOG_UPDATE->value) || $blog->user_id==$user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Blog $blog): bool
    {
        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::BLOG_ALL->value,
            PermissionsEnum::BLOG_DELETE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Blog $blog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Blog $blog): bool
    {
        return false;
    }
}
