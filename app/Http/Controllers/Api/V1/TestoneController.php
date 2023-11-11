<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Testone;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTestoneRequest;
use App\Http\Requests\StoreTestoneRequest;
use App\Http\Resources\TestoneResource;
use App\Actions\Testone\StoreTestoneAction;
use App\Actions\Testone\DeleteTestoneAction;
use App\Actions\Testone\UpdateTestoneAction;
use App\Repositories\Testone\TestoneRepositoryInterface;


class TestoneController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Testone::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TestoneRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(TestoneResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Testone $testone): JsonResponse
    {
        return $this->successResponse(TestoneResource::make($testone));
    }


    public function store(StoreTestoneRequest $request): JsonResponse
    {
        $model = StoreTestoneAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('testone.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestoneRequest $request, Testone $testone): JsonResponse
    {
        $data = UpdateTestoneAction::run($testone, $request->all());
        return $this->successResponse(TestoneResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('testone.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testone $testone): JsonResponse
    {
        DeleteTestoneAction::run($testone);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('testone.model')]));
    }
}
