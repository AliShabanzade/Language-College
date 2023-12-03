<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Gallery;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Resources\GalleryResource;
use App\Actions\Gallery\StoreGalleryAction;
use App\Actions\Gallery\DeleteGalleryAction;
use App\Actions\Gallery\UpdateGalleryAction;
use App\Repositories\Gallery\GalleryRepositoryInterface;


class GalleryController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Gallery::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GalleryRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(GalleryResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery): JsonResponse
    {
        return $this->successResponse(GalleryResource::make($gallery));
    }


    public function store(StoreGalleryRequest $request): JsonResponse
    {
        $model = StoreGalleryAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('gallery.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery): JsonResponse
    {
        $data = UpdateGalleryAction::run($gallery, $request->all());
        return $this->successResponse(GalleryResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('gallery.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): JsonResponse
    {
        DeleteGalleryAction::run($gallery);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('gallery.model')]));
    }
}
