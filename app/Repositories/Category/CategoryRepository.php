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
                           ->when(isset($payload['children']) && !isset($payload['parent']), function ($query) {
                               return $query->with('children');
                           })
                           ->when(isset($payload['parent']) && !isset($payload['children']), function ($query) {
                               return $query->with('parent');
                           })
                           ->when(isset($payload['parent']) && isset($payload['children']), function ($query) {
                               return $query->with(['parent', 'children']);
                           });
    }

    public function restore($slug)
    {

        $category =$this->getModel()->where('slug', $slug)->withTrashed()->first();
        if ($category) {
            $category->restore(); // This line restores the soft-deleted category.
        }
        dd($category);
        return $category;
    }

}
