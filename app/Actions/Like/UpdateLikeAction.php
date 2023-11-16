<?php

namespace App\Actions\Like;

use App\Enums\PermissionEnum;
use App\Models\Like;
use App\Repositories\Like\LikeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateLikeAction
{
    use AsAction;

    public function __construct(private readonly LikeRepositoryInterface $repository)
    {
    }


    /**
     * @param Like                                          $like
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Like
     */
    public function handle(Like $like, array $payload): Like
    {
        return DB::transaction(function () use ($like, $payload) {
            $like->update($payload);
            return $like;
        });
    }
}
