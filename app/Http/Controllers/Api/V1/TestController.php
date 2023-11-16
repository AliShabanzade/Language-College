<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Test;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTestRequest;
use App\Http\Requests\StoreTestRequest;
use App\Http\Resources\TestResource;
use App\Actions\Test\StoreTestAction;
use App\Actions\Test\DeleteTestAction;
use App\Actions\Test\UpdateTestAction;
use App\Repositories\Test\TestRepositoryInterface;


class TestController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Test::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TestRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(TestResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test): JsonResponse
    {
        return $this->successResponse(TestResource::make($test));
    }


    public function store(StoreTestRequest $request): JsonResponse
    {
        $model = StoreTestAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('test.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestRequest $request, Test $test): JsonResponse
    {
        $data = UpdateTestAction::run($test, $request->all());
        return $this->successResponse(TestResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('test.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test): JsonResponse
    {
        DeleteTestAction::run($test);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('test.model')]));
    }
}
