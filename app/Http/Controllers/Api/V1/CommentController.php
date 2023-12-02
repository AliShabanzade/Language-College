<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Comment\DeleteCommentAction;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\JsonResponse;


class CommentController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api')->except("index");
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CommentRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(CommentResource::collection($repository->paginate()));
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $this->authorize('delete',$comment);
        DeleteCommentAction::run($comment);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('comment.model')]));
    }
}
