<?php

namespace App\Repositories\Department;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Department;

interface DepartmentRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Department;
}
