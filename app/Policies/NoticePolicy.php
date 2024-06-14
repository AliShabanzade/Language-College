<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Notice;
use App\Models\User;

class NoticePolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::NOTICE_ALL->value,
            PermissionsEnum::NOTICE_STORE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Notice $notice): bool
    {
        return $user->hasAnyPermission(
                PermissionsEnum::ADMIN->value,
                PermissionsEnum::NOTICE_ALL->value,
                PermissionsEnum::NOTICE_UPDATE->value) ||
            $user->id === $notice->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Notice $notice): bool
    {

        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::NOTICE_ALL->value,
            PermissionsEnum::NOTICE_DELETE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Notice $notice): bool
    {
        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::NOTICE_ALL->value,
            PermissionsEnum::NOTICE_RESTORE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Notice $notice): bool
    {
        return $user->hasAnyPermission(
            PermissionsEnum::ADMIN->value);
    }
}
