<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
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

    public function query(array $payload = []): Builder|QueryBuilder
    {

        return QueryBuilder::for($this->model)
            ->allowedIncludes(['parent', 'children'])
            ->allowedFilters(['published'])
            ->when(isset($payload['children']) && !isset($payload['parent']), function (Builder $query) {
                $query->with('children');
            })
            ->when(isset($payload['parent']) && !isset($payload['children']), function (Builder $query) {
                $query->with('parent');
            })
            ->when(isset($payload['parent']) && isset($payload['children']), function (Builder $query) {
                $query->with(['parent', 'children']);
            })
            ; // You might want to use ->paginate() here depending on your needs
    }



}
