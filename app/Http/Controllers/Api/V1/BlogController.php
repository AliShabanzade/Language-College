<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Blog\DeleteBlogAction;
use App\Actions\Blog\StoreBlogAction;
use App\Actions\Blog\UpdateBlogAction;
use App\Actions\Comment\StoreCommentAction;
use App\Actions\Like\AddLike;
use App\Actions\View\AddView;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Http\JsonResponse;


class BlogController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
        $this->authorizeResource(Blog::class, options: [
            'except' => ['index', 'show']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BlogRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(BlogResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog): JsonResponse
    {
        AddView::run($blog);
        return $this->successResponse(BlogResource::make($blog
            ->load(['user', 'category', 'likes', 'comments', 'views', 'translations'])));
    }

    public function store(StoreBlogRequest $request): JsonResponse
    {
        $model = StoreBlogAction::run($request->validated());
        return $this->successResponse(BlogResource::make($model
            ->load('user', 'category', 'translations')),
            trans('general.model_has_stored_successfully', ['model' => trans('blog.model')]));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog): JsonResponse
    {
        $this->authorize('update', $blog);
        $data = UpdateBlogAction::run($blog, $request->validated());
        return $this->successResponse(BlogResource::make($data),
            trans('general.model_has_updated_successfully',
                ['model' => trans('blog.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): JsonResponse
    {
        DeleteBlogAction::run($blog);
        return $this->successResponse(
            trans('general.model_has_deleted_successfully',
                ['model' => trans('blog.model')]));
    }

    public function addLike(Blog $blog): bool
    {
        AddLike::run($blog);
        return true;
    }

    public function comment(StoreCommentRequest $request, Blog $blog)
    {
        $data = StoreCommentAction::run($blog, $request->validated());
        return $this->successResponse($data, 'sss');
    }
}
