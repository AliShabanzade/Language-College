<?php

namespace App\Repositories\Classroom;

use App\Models\Classroom;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ClassroomRepository extends BaseRepository implements ClassroomRepositoryInterface
{
    public function __construct(Classroom $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Classroom
   {
       return parent::getModel();
   }
}
