<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Department;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Actions\Department\StoreDepartmentAction;
use App\Actions\Department\DeleteDepartmentAction;
use App\Actions\Department\UpdateDepartmentAction;
use App\Repositories\Department\DepartmentRepositoryInterface;


class DepartmentController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Department::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(DepartmentRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(DepartmentResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department): JsonResponse
    {
        return $this->successResponse(DepartmentResource::make($department));
    }


    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        $model = StoreDepartmentAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('department.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        $data = UpdateDepartmentAction::run($department, $request->all());
        return $this->successResponse(DepartmentResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('department.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department): JsonResponse
    {
        DeleteDepartmentAction::run($department);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('department.model')]));
    }
}
