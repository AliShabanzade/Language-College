<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCategoryAction
{
    use AsAction;

    public function __construct(public readonly CategoryRepositoryInterface $repository)
    {
    }

    public function handle(Category $category): bool
    {
        return DB::transaction(function () use ($category) {
            return $this->repository->delete($category);
        });
    }
}
