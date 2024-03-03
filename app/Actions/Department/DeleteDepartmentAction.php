<?php

namespace App\Actions\Department;

use App\Models\Department;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteDepartmentAction
{
    use AsAction;

    public function __construct(public readonly DepartmentRepositoryInterface $repository)
    {
    }

    public function handle(Department $department): bool
    {
        return DB::transaction(function () use ($department) {
            return $this->repository->delete($department);
        });
    }
}
