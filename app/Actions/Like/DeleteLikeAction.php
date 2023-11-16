<?php

namespace App\Actions\Like;

use App\Models\Like;
use App\Repositories\Like\LikeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteLikeAction
{
    use AsAction;

    public function __construct(public readonly LikeRepositoryInterface $repository)
    {
    }

    public function handle(Like $like): bool
    {
        return DB::transaction(function () use ($like) {
            return $this->repository->delete($like);
        });
    }
}
