<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Publication;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdatePublicationRequest;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Resources\PublicationResource;
use App\Actions\Publication\StorePublicationAction;
use App\Actions\Publication\DeletePublicationAction;
use App\Actions\Publication\UpdatePublicationAction;
use App\Repositories\Publication\PublicationRepositoryInterface;


class PublicationController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Publication::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PublicationRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(PublicationResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication): JsonResponse
    {
        return $this->successResponse(PublicationResource::make($publication));
    }


    public function store(StorePublicationRequest $request): JsonResponse
    {

        $model = StorePublicationAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('publication.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublicationRequest $request, Publication $publication): JsonResponse
    {
        $data = UpdatePublicationAction::run($publication, $request->validated());
        return $this->successResponse(PublicationResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('publication.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication): JsonResponse
    {
        DeletePublicationAction::run($publication);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('publication.model')]));
    }
}
