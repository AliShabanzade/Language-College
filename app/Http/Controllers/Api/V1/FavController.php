<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Fav;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateFavRequest;
use App\Http\Requests\StoreFavRequest;
use App\Http\Resources\FavResource;
use App\Actions\Fav\StoreFavAction;
use App\Actions\Fav\DeleteFavAction;
use App\Actions\Fav\UpdateFavAction;
use App\Repositories\Fav\FavRepositoryInterface;


class FavController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Fav::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FavRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(FavResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Fav $fav): JsonResponse
    {
        return $this->successResponse(FavResource::make($fav));
    }


    public function store(StoreFavRequest $request): JsonResponse
    {
        $model = StoreFavAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('fav.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavRequest $request, Fav $fav): JsonResponse
    {
        $data = UpdateFavAction::run($fav, $request->all());
        return $this->successResponse(FavResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('fav.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fav $fav): JsonResponse
    {
        DeleteFavAction::run($fav);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('fav.model')]));
    }
}
