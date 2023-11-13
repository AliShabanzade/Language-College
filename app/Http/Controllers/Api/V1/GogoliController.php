<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Gogoli;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateGogoliRequest;
use App\Http\Requests\StoreGogoliRequest;
use App\Http\Resources\GogoliResource;
use App\Actions\Gogoli\StoreGogoliAction;
use App\Actions\Gogoli\DeleteGogoliAction;
use App\Actions\Gogoli\UpdateGogoliAction;
use App\Repositories\Gogoli\GogoliRepositoryInterface;


class GogoliController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Gogoli::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GogoliRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(GogoliResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Gogoli $gogoli): JsonResponse
    {
        return $this->successResponse(GogoliResource::make($gogoli));
    }


    public function store(StoreGogoliRequest $request): JsonResponse
    {
        $model = StoreGogoliAction::run($request->validated());
        return $this->successResponse($model, 'gogoli successfully created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGogoliRequest $request, Gogoli $gogoli): JsonResponse
    {
        $data = UpdateGogoliAction::run($gogoli, $request->all());
        return $this->successResponse(GogoliResource::make($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gogoli $gogoli): JsonResponse
    {
        DeleteGogoliAction::run($gogoli);
        return $this->successResponse('', 'gogoli has been deleted successfully');
    }
}
