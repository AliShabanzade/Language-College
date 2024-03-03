<?php

namespace App\Repositories\College;

use App\Repositories\BaseRepositoryInterface;
use App\Models\College;

interface CollegeRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): College;
}
