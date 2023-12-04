<?php

namespace App\Actions\Role;


use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class DeleteRoleAction
{
    use AsAction;

    public function __construct(public readonly RoleRepositoryInterface $repository)
    {
    }
    public function handle(Role $role): bool
    {
        return DB::transaction(function () use ($role) {
            $role->permissions()->detach();
            return $this->repository->delete($role);
        });
    }
}
