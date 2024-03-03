<?php

namespace App\Repositories\Term;

use App\Models\Term;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class TermRepository extends BaseRepository implements TermRepositoryInterface
{
    public function __construct(Term $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Term
   {
       return parent::getModel();
   }
}
