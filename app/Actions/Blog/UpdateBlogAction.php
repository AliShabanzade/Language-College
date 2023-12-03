<?php

namespace App\Actions\Blog;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateBlogAction
{
    use AsAction;

    public function __construct(
        private readonly BlogRepositoryInterface $repository,
        private readonly CategoryRepositoryInterface $categoryRepository,

    )
    {
    }


    /**
     * @param Blog                                          $blog
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Blog
     */
    public function handle(Blog $blog, array $payload): Blog|null
    {
        return DB::transaction(function () use ($blog, $payload) {
            $category = $this->categoryRepository->find($payload['category_id']);
            if ($category->type === Blog::class) {
                $payload['user_id'] = auth()->id();
                $blog->media()->delete();
                $blog->update($payload);
                SetTranslationAction::translate($blog, $payload['translations']);
                if (request()->hasFile('media')) {
                    $blog->addMediaFromRequest('media')
                         ->toMediaCollection('blog');
                }
                return $blog;
            }
            return null;
        });
    }
}
