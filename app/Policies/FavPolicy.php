<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Fav;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FavPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::FAV_ALL->value,
            PermissionsEnum::FAV_INDEX->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Fav $fav): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::FAV_ALL->value,
            PermissionsEnum::FAV_INDEX->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::FAV_ALL->value,
            PermissionsEnum::FAV_INDEX->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Fav $fav): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::FAV_ALL->value,
            PermissionsEnum::FAV_INDEX->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fav $fav): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::FAV_ALL->value,
            PermissionsEnum::FAV_INDEX->value);
    }


}
