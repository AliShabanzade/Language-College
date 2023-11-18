<?php

namespace App\Repositories\Test2;

use App\Models\Test2;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class Test2Repository extends BaseRepository implements Test2RepositoryInterface
{
    public function __construct(Test2 $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Test2
   {
       return parent::getModel();
   }
}
