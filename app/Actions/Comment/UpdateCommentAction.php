<?php

namespace App\Actions\Comment;

use App\Enums\PermissionEnum;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCommentAction
{
    use AsAction;

    public function __construct(private readonly CommentRepositoryInterface $repository)
    {
    }


    /**
     * @param Comment                                          $comment
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Comment
     */
    public function handle(Comment $comment, array $payload): Comment
    {
        return DB::transaction(function () use ($comment, $payload) {
            $comment->update($payload);
            return $comment;
        });
    }
}
