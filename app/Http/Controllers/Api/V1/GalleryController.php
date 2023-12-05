<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Comment\StoreCommentAction;
use App\Actions\Gallery\DeleteGalleryAction;
use App\Actions\Gallery\StoreGalleryAction;
use App\Actions\Gallery\UpdateGalleryAction;
use App\Actions\View\AddView;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use Illuminate\Http\JsonResponse;


class GalleryController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GalleryRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(GalleryResource::collection($repository->query(request()->all())->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery): JsonResponse
    {
        AddView::run($gallery);
        return $this->successResponse(GalleryResource::make($gallery));
    }


    public function store(StoreGalleryRequest $request): JsonResponse
    {
        $this->authorize('create', Gallery::class);
        $model = StoreGalleryAction::run($request->validated());
        return $this->successResponse($model,
            trans('general.model_has_stored_successfully',
                ['model' => trans('gallery.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery): JsonResponse
    {
        $this->authorize('update', $gallery);
        $data = UpdateGalleryAction::run($gallery, $request->all());
        return $this->successResponse(GalleryResource::make($data),
            trans('general.model_has_updated_successfully',
                ['model' => trans('gallery.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): JsonResponse
    {
        $this->authorize('delete', $gallery);
        DeleteGalleryAction::run($gallery);
        return $this->successResponse('',
            trans('general.model_has_deleted_successfully',
                ['model' => trans('gallery.model')]));
    }

    public function toggle(Gallery $gallery , GalleryRepositoryInterface $repository): JsonResponse
    {
      $data = $repository->toggle($gallery);
      return $this->successResponse(GalleryResource::make($data), '');
    }

    public function addLike(Gallery $gallery): bool
    {
       $gallery->like();
       return true;
    }

    public function comment(StoreCommentRequest $request, Gallery $gallery)
    {
        $data = StoreCommentAction::run($gallery, $request->validated());
        return $this->successResponse($data,'');
    }
}
