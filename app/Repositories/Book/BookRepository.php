<?php

namespace App\Repositories\Book;

use App\Filters\FiltersSearch;
use App\Models\Book;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
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

    public function query(array $payload=[]):Builder|QueryBuilder
    {
        return QueryBuilder::for($this->model)
            ->defaultSort('-id')
            ->with(['category','user','publication','translations'])
            ->allowedSorts([
                AllowedSort::field('view_count','extra_attributes->view_count'),
                AllowedSort::field('view_count','extra_attributes->like_count'),
            ])
            ->allowedFilters([
                'published',
                AllowedFilter::custom('search', new FiltersSearch([
                    'key' => ['name']
                ])),
            ]); // Execute the query and return the result
    }

    public function subtractBookInventory($bookId, $quantity)
    {
        // TODO: Implement subtractBookInventory() method.
    }
}
