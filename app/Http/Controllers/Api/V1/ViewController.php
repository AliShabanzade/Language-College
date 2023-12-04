<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\View;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateViewRequest;
use App\Http\Requests\StoreViewRequest;
use App\Http\Resources\ViewResource;
use App\Actions\View\StoreViewAction;
use App\Actions\View\DeleteViewAction;
use App\Actions\View\AddView;
use App\Repositories\View\ViewRepositoryInterface;


class ViewController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(View::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ViewRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(ViewResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view): JsonResponse
    {
        return $this->successResponse(ViewResource::make($view));
    }


    public function store(StoreViewRequest $request): JsonResponse
    {
        $model = StoreViewAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('view.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViewRequest $request, View $view): JsonResponse
    {
        $data = AddView::run($view, $request->all());
        return $this->successResponse(ViewResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('view.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view): JsonResponse
    {
        DeleteViewAction::run($view);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('view.model')]));
    }
}
