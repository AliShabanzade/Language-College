<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Actions\Comment\StoreCommentAction;
use App\Actions\Comment\DeleteCommentAction;
use App\Actions\Comment\UpdateCommentAction;
use App\Repositories\Comment\CommentRepositoryInterface;


class CommentController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Comment::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CommentRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(CommentResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): JsonResponse
    {
        return $this->successResponse(CommentResource::make($comment));
    }


    public function store(StoreCommentRequest $request): JsonResponse
    {
        $model = StoreCommentAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('comment.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment): JsonResponse
    {
        $data = UpdateCommentAction::run($comment, $request->all());
        return $this->successResponse(CommentResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('comment.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): JsonResponse
    {
        DeleteCommentAction::run($comment);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('comment.model')]));
    }
}
