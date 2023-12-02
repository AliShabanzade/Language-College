<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Notice\DeleteNoticeAction;
use App\Actions\Notice\StoreNoticeAction;
use App\Actions\Notice\UpdateNoticeAction;
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
        $this->middleware('auth:api');
        $this->authorizeResource(Notice::class);
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
        return $this->successResponse(NoticeResource::make($notice->load('media')));
    }


    public function store(StoreNoticeRequest $request): JsonResponse
    {
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
//
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
        DeleteNoticeAction::run($notice);
        return $this->successResponse('', trans(
            'general.model_has_deleted_successfully',
            ['model' => trans('notice.model')]));
    }


    public function toggle(Notice $notice , NoticeRepositoryInterface $repository)
    {
        $data= $repository->toggle($notice);
        return $this->successResponse(NoticeResource::make($data) , '');
    }
}

