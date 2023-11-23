<?php

namespace App\Actions\Book;

use App\Actions\Translation\TranslationAction;
use App\Enums\CategoryEnum;
use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreBookAction
{
    use AsAction;

    public function __construct(private readonly BookRepositoryInterface     $repository,
                                private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function handle(array $payload): Book
    {
        return DB::transaction(function () use ($payload) {
            $category = $this->categoryRepository->find($payload['category_id']);

            if ($category->type == Book::class) {
               // $payload['user_id'] = auth()->user()->id;

                $model = $this->repository->store($payload);
                TranslationAction::run($model,$payload['translation']);

                return $model;
            }
            return null;
        });
    }
}
