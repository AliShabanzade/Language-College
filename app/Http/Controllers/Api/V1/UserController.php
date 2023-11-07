<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

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
    public function index(Request $request, UserRepositoryInterface $repository)
    {

        if ($request->input('limit') === -1) {
            $user = $repository->get($request->all());
        } else {
            $user = $repository->paginate($request->input('limit', '5'), $request->all());
            return $this->successResponse(UserResource::collection($user));
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(User $user , UserRepositoryInterface $repository)
    {
        $data= $repository->find($user->id );
        return $this->successResponse(UserResource::make($data),'نمایش یوزر ','201');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user , UserRequest $request)
    {
//        dd(10);

        $data= UpdateUserAction::run($user , $request->all());

        return $this->successResponse(UserResource::make($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
       DeleteUserAction::run($user);
       return $this->successResponse('' , 'user has been deleted successfully');
    }

    public function toggle(User $user, UserRepositoryInterface $repository)
    {
        $repository->toggle($user);
        return $this->successResponse($user , 'user update successful');
    }
}
