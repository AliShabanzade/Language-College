<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Faq;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FaqPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Faq $faq): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        return $user->hasAnyPermission(PermissionsEnum::FAQ_ALL->value,
            PermissionsEnum::FAQ_STORE->value, PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Faq $faq): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::FAQ_ALL->value, PermissionsEnum::FAQ_UPDATE->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Faq $faq): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::FAQ_ALL->value, PermissionsEnum::FAQ_DELETE->value,
            PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Faq $faq): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::FAQ_RESTORE->value, PermissionsEnum::ADMIN->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Faq $faq): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::FAQ_ALL->value, PermissionsEnum::ADMIN->value);
    }
}
