<?php

namespace App\Repositories\Bok;

use App\Models\Bok;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class BokRepository extends BaseRepository implements BokRepositoryInterface
{
    public function __construct(Bok $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Bok
   {
       return parent::getModel();
   }
}
