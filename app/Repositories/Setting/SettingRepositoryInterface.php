<?php

namespace App\Repositories\Setting;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Setting;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Setting;
}
