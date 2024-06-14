<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PublicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value, PermissionsEnum::PUBLICATION_ALL->value, PermissionsEnum::PUBLICATION_INDEX->value]);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Publication $publication): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value, PermissionsEnum::PUBLICATION_ALL->value, PermissionsEnum::PUBLICATION_SHOW->value]);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value, PermissionsEnum::PUBLICATION_ALL->value, PermissionsEnum::PUBLICATION_SHOW->value])
            ;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Publication $publication): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value, PermissionsEnum::PUBLICATION_ALL->value, PermissionsEnum::PUBLICATION_SHOW->value]);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Publication $publication): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value, PermissionsEnum::PUBLICATION_ALL->value, PermissionsEnum::PUBLICATION_SHOW->value]);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Publication $publication): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value]);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Publication $publication): bool
    {
        return $user->hasAnyPermission([PermissionsEnum::ADMIN->value]);

    }
}
