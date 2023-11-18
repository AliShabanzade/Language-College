<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Like;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateLikeRequest;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Resources\LikeResource;
use App\Actions\Like\StoreLikeAction;
use App\Actions\Like\DeleteLikeAction;
use App\Actions\Like\UpdateLikeAction;
use App\Repositories\Like\LikeRepositoryInterface;


class LikeController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Like::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(LikeRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(LikeResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like): JsonResponse
    {
        return $this->successResponse(LikeResource::make($like));
    }


    public function store(StoreLikeRequest $request): JsonResponse
    {
        $model = StoreLikeAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('like.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like): JsonResponse
    {
        $data = UpdateLikeAction::run($like, $request->all());
        return $this->successResponse(LikeResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('like.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like): JsonResponse
    {
        DeleteLikeAction::run($like);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('like.model')]));
    }
}
