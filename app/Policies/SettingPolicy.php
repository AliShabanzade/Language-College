<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
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
        return $user->hasAnyPermission(PermissionEnum::ADMIN->value,PermissionEnum::SETTING_ALL->value,
            PermissionEnum::SETTING_INDEX->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ADMIN->value,PermissionEnum::SETTING_ALL->value,
            PermissionEnum::SETTING_SHOW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ADMIN->value,PermissionEnum::SETTING_ALL->value,
            PermissionEnum::SETTING_STORE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ADMIN->value,PermissionEnum::SETTING_ALL->value,
            PermissionEnum::SETTING_UPDATE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ADMIN->value,PermissionEnum::SETTING_ALL->value,
            PermissionEnum::SETTING_DELETE->value);
    }


}
