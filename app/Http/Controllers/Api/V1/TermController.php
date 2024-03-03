<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Term;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTermRequest;
use App\Http\Requests\StoreTermRequest;
use App\Http\Resources\TermResource;
use App\Actions\Term\StoreTermAction;
use App\Actions\Term\DeleteTermAction;
use App\Actions\Term\UpdateTermAction;
use App\Repositories\Term\TermRepositoryInterface;


class TermController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Term::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TermRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(TermResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term): JsonResponse
    {
        return $this->successResponse(TermResource::make($term));
    }


    public function store(StoreTermRequest $request): JsonResponse
    {
        $model = StoreTermAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('term.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTermRequest $request, Term $term): JsonResponse
    {
        $data = UpdateTermAction::run($term, $request->all());
        return $this->successResponse(TermResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('term.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term): JsonResponse
    {
        DeleteTermAction::run($term);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('term.model')]));
    }
}
