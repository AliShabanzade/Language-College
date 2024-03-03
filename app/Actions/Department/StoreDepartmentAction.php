<?php

namespace App\Actions\Department;

use App\Models\Department;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreDepartmentAction
{
    use AsAction;

    public function __construct(private readonly DepartmentRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Department
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
