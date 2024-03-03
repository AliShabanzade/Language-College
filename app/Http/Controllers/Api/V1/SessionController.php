<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Session;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateSessionRequest;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Resources\SessionResource;
use App\Actions\Session\StoreSessionAction;
use App\Actions\Session\DeleteSessionAction;
use App\Actions\Session\UpdateSessionAction;
use App\Repositories\Session\SessionRepositoryInterface;


class SessionController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Session::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SessionRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(SessionResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session): JsonResponse
    {
        return $this->successResponse(SessionResource::make($session));
    }


    public function store(StoreSessionRequest $request): JsonResponse
    {
        $model = StoreSessionAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('session.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSessionRequest $request, Session $session): JsonResponse
    {
        $data = UpdateSessionAction::run($session, $request->all());
        return $this->successResponse(SessionResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('session.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session): JsonResponse
    {
        DeleteSessionAction::run($session);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('session.model')]));
    }
}
