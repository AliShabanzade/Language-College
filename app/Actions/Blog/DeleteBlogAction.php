<?php

namespace App\Actions\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteBlogAction
{
    use AsAction;

    public function __construct(public readonly BlogRepositoryInterface $repository)
    {
    }

    public function handle(Blog $blog): bool
    {
        return DB::transaction(function () use ($blog) {
            $blog->translations()->delete();
            $blog->media()->delete();
            return $this->repository->delete($blog);
        });
    }
}
