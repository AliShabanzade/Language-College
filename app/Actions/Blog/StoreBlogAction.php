<?php

namespace App\Actions\Blog;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class  StoreBlogAction
{
    use AsAction;

    public function __construct(
        private readonly BlogRepositoryInterface $repository,
        private readonly CategoryRepositoryInterface $categoryRepository,
    )
    {
    }

// lode
    public function handle(array $payload): Blog|null
    {
        return DB::transaction(function () use ($payload) {
            $category = $this->categoryRepository->find($payload['category_id'], firstOrFail: true);
            if ($category->type === Blog::class) {
                $payload['user_id'] = auth()->id();
                $blog = $this->repository->store($payload);
                SetTranslationAction::run($blog, $payload['translations']);
                if (request()?->hasFile('media')) {
                    $blog->addMediaFromRequest('media')
                         ->toMediaCollection('blog');
                }
                return $blog;
            }
            abort(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, "not found");
        });
    }
}
