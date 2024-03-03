<?php

namespace App\Repositories\TermDate;

use App\Models\TermDate;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class TermDateRepository extends BaseRepository implements TermDateRepositoryInterface
{
    public function __construct(TermDate $model)
    {
        parent::__construct($model);
    }

   public function getModel(): TermDate
   {
       return parent::getModel();
   }
}
