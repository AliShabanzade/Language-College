<?php

namespace App\Actions\Test;

use App\Models\Test;
use App\Repositories\Test\TestRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTestAction
{
    use AsAction;

    public function __construct(private readonly TestRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Test
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
