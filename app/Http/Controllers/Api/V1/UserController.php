<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Actions\User\StoreUserAction;
use App\Actions\User\DeleteUserAction;
use App\Actions\User\UpdateUserAction;
use App\Repositories\User\UserRepositoryInterface;


class UserController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserRepositoryInterface $repository): JsonResponse
    {
        $users = $repository->paginate();
        return $this->successResponse(UserResource::collection($users));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return $this->successResponse(UserResource::make($user->load('media')));
    }


    public function store(StoreUserRequest $request): JsonResponse
    {
        $model = StoreUserAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully', ['model' => trans('user.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = UpdateUserAction::run($user, $request->all());
        return $this->successResponse(UserResource::make($data),trans('general.model_has_updated_successfully', ['model' => trans('user.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        DeleteUserAction::run($user);
        return $this->successResponse('', trans('general.model_has_deleted_successfully', ['model' => trans('user.model')]));
    }

    public function toggle(User $user, UserRepositoryInterface $repository): JsonResponse
    {
        $user = $repository->toggle($user, 'block');
        return $this->successResponse($user, trans('general.model_has_toggled_successfully', ['model' => trans('user.model')]));
    }
}
