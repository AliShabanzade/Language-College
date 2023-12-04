<?php

namespace App\Actions\Like;

use App\Models\Like;
use App\Repositories\Like\LikeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class AddLike
{
    use AsAction;

    public function __construct()
    {
    }

    public function handle($model): bool
    {
        return DB::transaction(function () use ($model) {
            $model->like();
            return true;
        });
    }
}
