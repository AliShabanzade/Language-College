<?php

namespace App\Actions\Role;

use App\Enums\PermissionEnum;
use App\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateRoleAction
{
    use AsAction;

    public function __construct(private readonly RoleRepositoryInterface $repository)
    {
    }


    /**
     * @param Role $role
     * @return Role
     */
    public function handle(Role $role, array $payload): Role
    {
        return DB::transaction(function () use ($role, $payload) {
            $role->syncPermissions($payload['permissions'])->update(['name' => $payload['name']]);
           // $this->repository->update($role,$payload);
            return $role;
        });
    }
}
