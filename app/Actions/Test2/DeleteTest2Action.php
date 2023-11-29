<?php

namespace App\Actions\Test2;

use App\Models\Test2;
use App\Repositories\Test2\Test2RepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTest2Action
{
    use AsAction;

    public function __construct(public readonly Test2RepositoryInterface $repository)
    {
    }

    public function handle(Test2 $test2): bool
    {
        return DB::transaction(function () use ($test2) {
            return $this->repository->delete($test2);
        });
    }
}
