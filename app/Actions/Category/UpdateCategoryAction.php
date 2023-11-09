<?php

namespace App\Actions\Category;

use App\Enums\PermissionEnum;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCategoryAction
{
    use AsAction;

    public function __construct(private readonly CategoryRepositoryInterface $repository)
    {
    }


    /**
     * @param Category                                          $category
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Category
     */
    public function handle(Category $category, array $payload): Category
    {
        return DB::transaction(function () use ($category, $payload) {
            $category->update($payload);
            return $category;
        });
    }
}