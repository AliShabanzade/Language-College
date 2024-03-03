<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Member;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Resources\MemberResource;
use App\Actions\Member\StoreMemberAction;
use App\Actions\Member\DeleteMemberAction;
use App\Actions\Member\UpdateMemberAction;
use App\Repositories\Member\MemberRepositoryInterface;


class MemberController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Member::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(MemberRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(MemberResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member): JsonResponse
    {
        return $this->successResponse(MemberResource::make($member));
    }


    public function store(StoreMemberRequest $request): JsonResponse
    {
        $model = StoreMemberAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('member.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member): JsonResponse
    {
        $data = UpdateMemberAction::run($member, $request->all());
        return $this->successResponse(MemberResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('member.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member): JsonResponse
    {
        DeleteMemberAction::run($member);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('member.model')]));
    }
}
