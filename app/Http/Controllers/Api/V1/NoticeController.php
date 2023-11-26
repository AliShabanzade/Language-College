<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Comment\StoreCommentAction;
use App\Actions\View\CreateOrUpdateViewAction;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Notice;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateNoticeRequest;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Actions\Notice\StoreNoticeAction;
use App\Actions\Notice\DeleteNoticeAction;
use App\Actions\Notice\UpdateNoticeAction;
use App\Repositories\Notice\NoticeRepositoryInterface;


class NoticeController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Notice::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(NoticeRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(NoticeResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice): JsonResponse
    {
        CreateOrUpdateViewAction::run($notice);
        return $this->successResponse(NoticeResource::make($notice));
    }


    public function store(StoreNoticeRequest $request): JsonResponse
    {
        $model = StoreNoticeAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('notice.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeRequest $request, Notice $notice): JsonResponse
    {
        $data = UpdateNoticeAction::run($notice, $request->all());
        return $this->successResponse(NoticeResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('notice.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice): JsonResponse
    {
        DeleteNoticeAction::run($notice);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('notice.model')]));
    }
    public function comment(StoreCommentRequest $request , Notice $notice)
    {
        $data = StoreCommentAction::run($notice, $request->validated());
        return $this->successResponse($data,trans('general.model_has_stored_successfully',['model'=> trans('comment.model')]));
    }

    public function addLike(Notice $notice)
    {
        $notice->Like();
        return 'ok';
    }
}
