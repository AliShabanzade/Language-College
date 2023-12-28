<?php

namespace App\Actions\Category;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCategoryAction
{
    use AsAction;



    public function __construct(private readonly CategoryRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Category|null
    {
        return DB::transaction(function () use ($payload) {
            if (!empty($payload['parent_id'])) {
                $categoryTyp = $this->repository->find($payload['parent_id']);
                if ($payload['type'] === $categoryTyp->type) {
                    $model = $this->repository->store($payload);
                    SetTranslationAction::handle($model, $payload['translation']);
                    return $model;
                }
                abort(Response::HTTP_UNPROCESSABLE_ENTITY,
                    trans('general.The_parent_category_is_not_related_to_this_model',
                        ['model' => trans('category.model')]));
            } else {
                $model = $this->repository->store($payload);
                SetTranslationAction::handle($model, $payload['translation']);
                return $model;
            }
            return null;

        });
    }
}
