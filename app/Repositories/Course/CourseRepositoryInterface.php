<?php

namespace App\Repositories\Course;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Course;

interface CourseRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Course;


}
