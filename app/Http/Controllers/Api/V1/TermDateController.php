<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\TermDate;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTermDateRequest;
use App\Http\Requests\StoreTermDateRequest;
use App\Http\Resources\TermDateResource;
use App\Actions\TermDate\StoreTermDateAction;
use App\Actions\TermDate\DeleteTermDateAction;
use App\Actions\TermDate\UpdateTermDateAction;
use App\Repositories\TermDate\TermDateRepositoryInterface;


class TermDateController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(TermDate::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TermDateRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(TermDateResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(TermDate $termDate): JsonResponse
    {
        return $this->successResponse(TermDateResource::make($termDate));
    }


    public function store(StoreTermDateRequest $request): JsonResponse
    {
        $model = StoreTermDateAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('termDate.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTermDateRequest $request, TermDate $termDate): JsonResponse
    {
        $data = UpdateTermDateAction::run($termDate, $request->all());
        return $this->successResponse(TermDateResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('termDate.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TermDate $termDate): JsonResponse
    {
        DeleteTermDateAction::run($termDate);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('termDate.model')]));
    }
}
