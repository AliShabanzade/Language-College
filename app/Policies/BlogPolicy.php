<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
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
            PermissionEnum::ADMIN->value,
            PermissionEnum::BLOG_ALL->value,
            PermissionEnum::BLOG_INDEX->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Blog $blog): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::BLOG_ALL->value,
            PermissionEnum::BLOG_SHOW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::BLOG_ALL->value,
            PermissionEnum::BLOG_STORE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Blog $blog): bool
    {
        return $user->hasAnyPermission(
                PermissionEnum::ADMIN->value,
                PermissionEnum::BLOG_ALL->value,
                PermissionEnum::BLOG_UPDATE->value) || $blog->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Blog $blog): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::BLOG_ALL->value,
            PermissionEnum::BLOG_DELETE->value);
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
