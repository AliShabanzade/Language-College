<?php

namespace App\Repositories\Book;

use App\Filters\FiltersSearch;
use App\Models\Book;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Book
   {
       return parent::getModel();
   }

    public function query(array $payload=[]):Builder
    {
        return QueryBuilder::for($this->model)
            ->with(['category','user','publication'])
            ->allowedFilters([
                'published',
                AllowedFilter::scope('with_relations'),
                AllowedFilter::custom('search', new FiltersSearch([
                    'key' => ['title']
                ])),
            ]); // Execute the query and return the result
    }

}
