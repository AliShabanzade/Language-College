<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\Role\DeleteRoleAction;
use App\Actions\Role\StoreRoleAction;
use App\Actions\Role\UpdateRoleAction;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RoleRepositoryInterface $repository): JsonResponse
    {

        return $this->successResponse(RoleResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): JsonResponse
    {
        return $this->successResponse(RoleResource::make($role));
    }


    public function store(StoreRoleRequest $request): JsonResponse
    {
        $model = StoreRoleAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully', ['model' => trans('role.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $data = UpdateRoleAction::run($role, $request->validated());
        return $this->successResponse(RoleResource::make($data), trans('general.model_has_updated_successfully', ['model' => trans('role.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        DeleteRoleAction::run($role);
        return $this->successResponse('', trans('general.model_has_deleted_successfully', ['model' => trans('role.model')]));
    }

    /**
     * Add a role to a user
     * **/
    public function addRole(Request $request, User $user)
    {
        $this->authorize('addRole', Role::class);
        $user->assignRole($request->input('role'));
        return $this->successResponse('', trans('role.addRole'));
    }

    public function removeRole(UserRepositoryInterface $repository, User $user, Role $role)
    {

        $this->authorize('removeRole', Role::class);
        $user = $repository->find($user->id);
        $model = $user->removeRole($role);
        return $this->successResponse('', trans('role.removeRole'));
    }


}
