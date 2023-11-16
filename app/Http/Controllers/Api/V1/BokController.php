<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Bok;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateBokRequest;
use App\Http\Requests\StoreBokRequest;
use App\Http\Resources\BokResource;
use App\Actions\Bok\StoreBokAction;
use App\Actions\Bok\DeleteBokAction;
use App\Actions\Bok\UpdateBokAction;
use App\Repositories\Bok\BokRepositoryInterface;


class BokController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Bok::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BokRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(BokResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Bok $bok): JsonResponse
    {
        return $this->successResponse(BokResource::make($bok));
    }


    public function store(StoreBokRequest $request): JsonResponse
    {
        $model = StoreBokAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('bok.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBokRequest $request, Bok $bok): JsonResponse
    {
        $data = UpdateBokAction::run($bok, $request->all());
        return $this->successResponse(BokResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('bok.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bok $bok): JsonResponse
    {
        DeleteBokAction::run($bok);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('bok.model')]));
    }
}
