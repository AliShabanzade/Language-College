<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class UserController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
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
        return $this->successResponse(UserResource::make($user));
    }


    public function store(UpdateUserRequest $request): JsonResponse
    {
        $model = StoreUserAction::run($request->validated());
        return $this->successResponse($model, 'user successfully created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = UpdateUserAction::run($user, $request->all());
        return $this->successResponse(UserResource::make($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    //todo lang
    public function destroy(User $user): JsonResponse
    {
        DeleteUserAction::run($user);
        return $this->successResponse('', 'user has been deleted successfully');
    }

    public function toggle(User $user, UserRepositoryInterface $repository): JsonResponse
    {
        $user = $repository->toggle($user, 'block');
        return $this->successResponse($user, 'user update successful');
    }
}
