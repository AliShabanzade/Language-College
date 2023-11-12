<?php

namespace App\Repositories\Test;

use App\Models\Test;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{
    public function __construct(Test $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Test
   {
       return parent::getModel();
   }
}
