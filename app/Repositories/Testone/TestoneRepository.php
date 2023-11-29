<?php

namespace App\Repositories\Testone;

use App\Models\Testone;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class TestoneRepository extends BaseRepository implements TestoneRepositoryInterface
{
    public function __construct(Testone $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Testone
   {
       return parent::getModel();
   }
}
