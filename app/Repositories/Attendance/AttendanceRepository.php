<?php

namespace App\Repositories\Attendance;

use App\Models\Attendance;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class AttendanceRepository extends BaseRepository implements AttendanceRepositoryInterface
{
    public function __construct(Attendance $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Attendance
   {
       return parent::getModel();
   }
}
