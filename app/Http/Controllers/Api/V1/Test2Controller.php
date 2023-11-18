<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Test2;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTest2Request;
use App\Http\Requests\StoreTest2Request;
use App\Http\Resources\Test2Resource;
use App\Actions\Test2\StoreTest2Action;
use App\Actions\Test2\DeleteTest2Action;
use App\Actions\Test2\UpdateTest2Action;
use App\Repositories\Test2\Test2RepositoryInterface;


class Test2Controller extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Test2::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Test2RepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(Test2Resource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Test2 $test2): JsonResponse
    {
        return $this->successResponse(Test2Resource::make($test2));
    }


    public function store(StoreTest2Request $request): JsonResponse
    {
        $model = StoreTest2Action::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('test2.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTest2Request $request, Test2 $test2): JsonResponse
    {
        $data = UpdateTest2Action::run($test2, $request->all());
        return $this->successResponse(Test2Resource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('test2.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test2 $test2): JsonResponse
    {
        DeleteTest2Action::run($test2);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('test2.model')]));
    }
}
