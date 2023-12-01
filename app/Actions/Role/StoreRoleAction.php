<?php

namespace App\Actions\Role;


use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class StoreRoleAction
{
    use AsAction;

    public function __construct(private readonly RoleRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Role
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            $model->syncPermissions($payload['permissions']);
            return $model;

        });
    }
}
