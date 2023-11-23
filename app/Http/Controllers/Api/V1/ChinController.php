<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Chin;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateChinRequest;
use App\Http\Requests\StoreChinRequest;
use App\Http\Resources\ChinResource;
use App\Actions\Chin\StoreChinAction;
use App\Actions\Chin\DeleteChinAction;
use App\Actions\Chin\UpdateChinAction;
use App\Repositories\Chin\ChinRepositoryInterface;


class ChinController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Chin::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ChinRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(ChinResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chin $chin): JsonResponse
    {
        return $this->successResponse(ChinResource::make($chin));
    }


    public function store(StoreChinRequest $request): JsonResponse
    {
        $model = StoreChinAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('chin.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChinRequest $request, Chin $chin): JsonResponse
    {
        $data = UpdateChinAction::run($chin, $request->all());
        return $this->successResponse(ChinResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('chin.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chin $chin): JsonResponse
    {
        DeleteChinAction::run($chin);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('chin.model')]));
    }
}
