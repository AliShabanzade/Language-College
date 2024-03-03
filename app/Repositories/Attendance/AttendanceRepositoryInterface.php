<?php

namespace App\Repositories\Attendance;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Attendance;

interface AttendanceRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Attendance;
}
