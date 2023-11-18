<?php

namespace App\Repositories\Opinion;

use App\Models\Opinion;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class OpinionRepository extends BaseRepository implements OpinionRepositoryInterface
{
    public function __construct(Opinion $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Opinion
   {
       return parent::getModel();
   }
}
