<?php

namespace App\Repositories\Category;

use App\Filters\FiltersCategoryTranslation;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Category
    {
        return parent::getModel();
    }

//    public function query(array $payload = []): Builder|QueryBuilder
//    {
//        return QueryBuilder::for($this->model)
//            ->when(isset($payload['children']) && !isset($payload['parent']), function ($query) {
//                return $query->with('children');
//            })
//            ->when(isset($payload['parent']) && !isset($payload['children']), function ($query) {
//                return $query->with('parent');
//            })
//            ->when(isset($payload['parent']) && isset($payload['children']), function ($query) {
//                return $query->with(['parent', 'children']);
//            })
//            ->when(isset($payload['published']), function ($query) use ($payload) {
//                return $query->where('published', $payload['published']);
//            }, function ($query) {
//                // If 'published' is not set, return all categories
//                return $query;
//            });
//    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->model)
            ->allowedFilters([
                'published',
                AllowedFilter::scope('with_relations'),
                AllowedFilter::scope('only_relation'),
                AllowedFilter::custom('search', new FiltersCategoryTranslation([
                    'key' => ['title']
                ])),
            ]); // Execute the query and return the result
    }


}

