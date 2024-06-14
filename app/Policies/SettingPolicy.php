<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SettingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::SETTING_ALL->value,
            PermissionsEnum::SETTING_INDEX->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::SETTING_ALL->value,
            PermissionsEnum::SETTING_SHOW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::SETTING_ALL->value,
            PermissionsEnum::SETTING_STORE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::SETTING_ALL->value,
            PermissionsEnum::SETTING_UPDATE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::SETTING_ALL->value,
            PermissionsEnum::SETTING_DELETE->value);
    }


}
