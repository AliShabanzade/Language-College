<?php

namespace App\Repositories\Classroom;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Classroom;

interface ClassroomRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Classroom;
}
