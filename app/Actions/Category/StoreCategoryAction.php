<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCategoryAction
{
    use AsAction;

    private readonly Category $category;

    public function __construct(private readonly CategoryRepositoryInterface $repository, Category $category)
    {
        $this->category = $category;
    }

    public function handle(array $payload): Category
    {

        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            $this->category->setAttribute('translation', $payload['translation']);
            return $model;
        });
    }
}
