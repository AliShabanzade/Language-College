<?php

namespace App\Actions\Fav;

use App\Models\Fav;
use App\Repositories\Fav\FavRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreFavAction
{
    use AsAction;

    public function __construct(private readonly FavRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Fav
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
