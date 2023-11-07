<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends ApiBaseController
{

//    public function __construct()
//    {
//        $this->middleware('auth:sanctum');
//        $this->authorizeResource(User::class);
//    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserRepositoryInterface $repository)
    {
        if ($request->input('limit') === -1) {
            $users = $repository->get($request->all());
        } else {
            $users = $repository->paginate($request->input('limit', '5'), $request->all());
        }
        return $this->successResponse(UserResource::collection($users));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, UserRepositoryInterface $repository)
    {
        return $this->successResponse(UserResource::make($user), 'نمایش یوزر ');
    }


    public function store(UserRequest $request  )
    {

        $model = StoreUserAction::run($request->validated());
        return $this->successResponse($model , 'user successfully created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = UpdateUserAction::run($user, $request->all());
        return $this->successResponse(UserResource::make($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DeleteUserAction::run($user);
        return $this->successResponse('', 'user has been deleted successfully');
    }

    public function toggle(User $user, UserRepositoryInterface $repository)
    {
        $user = $repository->toggle($user);
        return $this->successResponse($user, 'user update successful');
    }

    public function addPermission(Request $request, User $user)
    {
        //  $this->authorize('addRole', User::class);
        ($user->syncPermissions($request->permission));
        return $this->successResponse(
            UserResource::make($user),
            //"کاربر دارای نقش شد"
            'succesfully'
        );
    }

    public function addRole(Request $request, User $user)
    {
        //  $this->authorize('addRole', User::class);
        ($user->assignRole($request->role));
        return $this->successResponse(
            UserResource::make($user),
            //"کاربر دارای نقش شد"
            __('ApiMassage.addRole')
        );
    }

    public function removeRole(Request $request, UserRepositoryInterface $repository, User $user, Role $role)
    {

        //  $this->authorize('removeRole', User::class);
        $user = $repository->find($user->id);

        $model = $user->removeRole($role);
        // $user->removeRole($role);
        return $this->successResponse(
            UserResource::make($model),
            //"نقش با موفقیت حذف شد"
            __('ApiMassage.removeRole')
        );
    }
}
