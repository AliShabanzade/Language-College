<?php

namespace App\Actions\Test;

use App\Models\Test;
use App\Repositories\Test\TestRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTestAction
{
    use AsAction;

    public function __construct(public readonly TestRepositoryInterface $repository)
    {
    }

    public function handle(Test $test): bool
    {
        return DB::transaction(function () use ($test) {
            return $this->repository->delete($test);
        });
    }
}
