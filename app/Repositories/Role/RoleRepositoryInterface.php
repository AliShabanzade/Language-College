<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepositoryInterface;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Role;

}
