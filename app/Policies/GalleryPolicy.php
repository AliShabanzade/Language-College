<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GalleryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::GALLERY_ALL->value,
            PermissionEnum::GALLERY_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::GALLERY_ALL->value,
            PermissionEnum::GALLERY_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::GALLERY_ALL->value,
            PermissionEnum::GALLERY_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::GALLERY_ALL->value,
            PermissionEnum::GALLERY_UPDATE->value) ||
            $gallery->id === $gallery->user_id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::GALLERY_ALL->value,
            PermissionEnum::GALLERY_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value,
            PermissionEnum::GALLERY_ALL->value,
            PermissionEnum::GALLERY_RESTORE->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value);

    }


    public function toggle(User $user,Gallery $gallery): bool
    {
        return $user->hasAnyPermission(
            PermissionEnum::ADMIN->value);
    }

}
