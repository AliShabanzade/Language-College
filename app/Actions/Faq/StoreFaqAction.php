<?php

namespace App\Actions\Faq;

use App\Models\Faq;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreFaqAction
{
    use AsAction;

    public function __construct(private readonly FaqRepositoryInterface $repository ,
   private  readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function handle(array $payload): Faq
    {

        return DB::transaction(function () use ($payload) {
            $category= $this->categoryRepository->find($payload['category_id']);

            if ($category && $category->type === "App\Models\Faq"){
                $payload['user_id']=auth()->user()->id;
                return $this->repository->store($payload);
            }
            return null;
        });
    }
}
