<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCommentAction
{
    use AsAction;

    public function __construct(public readonly CommentRepositoryInterface $repository)
    {
    }

    public function handle(Comment $comment): bool
    {
        return DB::transaction(function () use ($comment) {
            return $this->repository->delete($comment);
        });
    }
}
