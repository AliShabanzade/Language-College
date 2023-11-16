<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Opinion;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateOpinionRequest;
use App\Http\Requests\StoreOpinionRequest;
use App\Http\Resources\OpinionResource;
use App\Actions\Opinion\StoreOpinionAction;
use App\Actions\Opinion\DeleteOpinionAction;
use App\Actions\Opinion\UpdateOpinionAction;
use App\Repositories\Opinion\OpinionRepositoryInterface;


class OpinionController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Opinion::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(OpinionRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(OpinionResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Opinion $opinion): JsonResponse
    {
        return $this->successResponse(OpinionResource::make($opinion));
    }


    public function store(StoreOpinionRequest $request): JsonResponse
    {
        $model = StoreOpinionAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('opinion.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpinionRequest $request, Opinion $opinion): JsonResponse
    {
        $data = UpdateOpinionAction::run($opinion, $request->all());
        return $this->successResponse(OpinionResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('opinion.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opinion $opinion): JsonResponse
    {
        DeleteOpinionAction::run($opinion);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('opinion.model')]));
    }
}
