<?php

namespace App\Actions\Test2;

use App\Models\Test2;
use App\Repositories\Test2\Test2RepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTest2Action
{
    use AsAction;

    public function __construct(private readonly Test2RepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Test2
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
