<?php

namespace App\Repositories\College;

use App\Models\College;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class CollegeRepository extends BaseRepository implements CollegeRepositoryInterface
{
    public function __construct(College $model)
    {
        parent::__construct($model);
    }

   public function getModel(): College
   {
       return parent::getModel();
   }
   public  function query(array $payload = []): Builder|QueryBuilder
   {
       return QueryBuilder::for($this->model)
           ->defaultSort('-id')
           ->with('translations');
   }

}
