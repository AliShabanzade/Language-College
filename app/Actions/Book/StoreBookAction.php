<?php

namespace App\Actions\Book;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\TableCategoryFieldTypeEnum;
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
            if ($category->type->value === TableCategoryFieldTypeEnum::BOOK->value) {
                $payload['user_id'] = auth()->user()->id;
                /** @var Book $model */
                $model = $this->repository->store($payload);
                if (request()->hasFile('media')) {
                    $model->addMediaFromRequest('media')
                        ->toMediaCollection('book');
                }
                SetTranslationAction::run($model, $payload['translations']);
                return $model->load('translations');
            }
            abort(Response::HTTP_UNPROCESSABLE_ENTITY,
	            trans('general.The_category_is_not_related_to_this_model',
		            ['model' => trans('book.model')]));
        });
    }
}
