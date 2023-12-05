<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Comment\StoreCommentAction;
use App\Actions\Notice\DeleteNoticeAction;
use App\Actions\Notice\StoreNoticeAction;
use App\Actions\Notice\UpdateNoticeAction;
use App\Actions\View\AddView;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Models\Notice;
use App\Repositories\Notice\NoticeRepositoryInterface;
use Illuminate\Http\JsonResponse;


class NoticeController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(NoticeRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(NoticeResource::collection($repository->query(request()->all())->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice): JsonResponse
    {
        AddView::run($notice);
        return $this->successResponse(NoticeResource::make($notice->load('media')));
    }


    public function store(StoreNoticeRequest $request): JsonResponse
    {
        $this->authorize('create', Notice::class);
        $model = StoreNoticeAction::run($request->validated());
        return $this->successResponse($model, trans(
            'general.model_has_stored_successfully',
            ['model' => trans('notice.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeRequest $request, Notice $notice): JsonResponse
    {
        $this->authorize('update', $notice);
        $data = UpdateNoticeAction::run($notice, $request->validated());
        return $this->successResponse(NoticeResource::make($data), trans(
            'general.model_has_updated_successfully',
            ['model' => trans('notice.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice): JsonResponse
    {
        $this->authorize('delete', $notice);
        DeleteNoticeAction::run($notice);
        return $this->successResponse('', trans(
            'general.model_has_deleted_successfully',
            ['model' => trans('notice.model')]));
    }


    public function toggle(Notice $notice, NoticeRepositoryInterface $repository)
    {
        $data = $repository->toggle($notice);
        return $this->successResponse(NoticeResource::make($data), '');
    }


    public function addLike(Notice $notice): bool
    {
        $notice->like();
        return true;
    }

    public function comment(StoreCommentRequest $request, Notice $notice)
    {
        $data = StoreCommentAction::run($notice, $request->validated());
        return $this->successResponse($data, '');
    }
}
