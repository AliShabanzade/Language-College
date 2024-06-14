<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
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
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::GALLERY_ALL->value, PermissionsEnum::GALLERY_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::GALLERY_ALL->value, PermissionsEnum::GALLERY_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::GALLERY_ALL->value, PermissionsEnum::GALLERY_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::GALLERY_ALL->value, PermissionsEnum::GALLERY_UPDATE->value) || $notice->id === $notice->user_id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::GALLERY_ALL->value, PermissionsEnum::GALLERY_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::GALLERY_ALL->value, PermissionsEnum::GALLERY_RESTORE->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gallery $gallery): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value);

    }
}
