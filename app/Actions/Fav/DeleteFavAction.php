<?php

namespace App\Actions\Fav;

use App\Models\Fav;
use App\Repositories\Fav\FavRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteFavAction
{
    use AsAction;

    public function __construct(public readonly FavRepositoryInterface $repository)
    {
    }

    public function handle(Fav $fav): bool
    {
        return DB::transaction(function () use ($fav) {
            $fav->translations()->delete();
            $fav->media()->delete();
            return $this->repository->delete($fav);
        });
    }
}
