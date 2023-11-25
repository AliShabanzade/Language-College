<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Chine;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateChineRequest;
use App\Http\Requests\StoreChineRequest;
use App\Http\Resources\ChineResource;
use App\Actions\Chine\StoreChineAction;
use App\Actions\Chine\DeleteChineAction;
use App\Actions\Chine\UpdateChineAction;
use App\Repositories\Chine\ChineRepositoryInterface;


class ChineController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Chine::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ChineRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(ChineResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chine $chine): JsonResponse
    {
        return $this->successResponse(ChineResource::make($chine));
    }


    public function store(StoreChineRequest $request): JsonResponse
    {
        $model = StoreChineAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('chine.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChineRequest $request, Chine $chine): JsonResponse
    {
        $data = UpdateChineAction::run($chine, $request->all());
        return $this->successResponse(ChineResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('chine.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chine $chine): JsonResponse
    {
        DeleteChineAction::run($chine);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('chine.model')]));
    }
}
