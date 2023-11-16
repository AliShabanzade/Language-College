<?php

namespace App\Actions\Like;

use App\Models\Like;
use App\Repositories\Like\LikeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreLikeAction
{
    use AsAction;

    public function __construct(private readonly LikeRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Like
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
