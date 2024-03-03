<?php

namespace App\Actions\Department;

use App\Enums\PermissionEnum;
use App\Models\Department;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateDepartmentAction
{
    use AsAction;

    public function __construct(private readonly DepartmentRepositoryInterface $repository)
    {
    }


    /**
     * @param Department                                          $department
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Department
     */
    public function handle(Department $department, array $payload): Department
    {
        return DB::transaction(function () use ($department, $payload) {
            $department->update($payload);
            return $department;
        });
    }
}
