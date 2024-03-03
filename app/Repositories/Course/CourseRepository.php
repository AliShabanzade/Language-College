<?php

namespace App\Repositories\Course;

use App\Models\Course;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Course
   {
       return parent::getModel();
   }

    public  function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
            ->defaultSort('-id')
            ->with('translations');
    }
}
