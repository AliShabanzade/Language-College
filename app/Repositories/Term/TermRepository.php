<?php

namespace App\Repositories\Term;

use App\Models\Term;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function query(array $payload=[]): Builder|QueryBuilder
    {
        $with=\Arr::get($payload, 'with');
        return QueryBuilder::for($this->getModel())
            ->when(isset($payload['with']) && in_array('course', $with),
                fn($q) => $q->with('course'))
            ->when(isset($payload['with']) && in_array('children', $with),
                fn($q) => $q->with('children'))
            ->when(isset($payload['with']) && in_array('prerequisite',$with),
                fn($q) => $q->with('prerequisite'))
            ->when(isset($payload['with']) && in_array('classrooms', $with),
                fn($q) => $q->with('classrooms'))
            ->when(isset($payload['with']) && in_array('translations', $with),
                fn($q) => $q->with('translations'))
            ->defaultSort('-id');

   }
}
