<?php

namespace App\Actions\Book;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\CategoryEnum;
use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreBookAction
{
    use AsAction;

    public function __construct(private readonly BookRepositoryInterface     $repository,
                                private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function handle(array $payload):Book
    {

        return DB::transaction(function () use ($payload) {
            $category = $this->categoryRepository->find($payload['category_id']);
            if ($category->type == Book::class) {
                $payload['user_id'] = auth()->user()->id;
                /** @var Book $model */
                $model = $this->repository->store($payload);

                if (request()->hasFile('media')) {
                    $model->addMediaFromRequest('media')
                        ->toMediaCollection('book');
                }
                SetTranslationAction::run($model, $payload['translations']);
                return $model;
            }
            abort(Response::HTTP_UNPROCESSABLE_ENTITY,"aaaaa");
        });
    }
}
