<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Comment\StoreCommentAction;
use App\Actions\Like\AddLike;
use App\Actions\View\AddView;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Actions\Book\StoreBookAction;
use App\Actions\Book\DeleteBookAction;
use App\Actions\Book\UpdateBookAction;
use App\Repositories\Book\BookRepositoryInterface;



class BookController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Book::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BookRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(BookResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): JsonResponse
    {
        AddView::run($book);
        return $this->successResponse(BookResource::make($book->load('user','category', 'media','publication')));
    }


    public function store(StoreBookRequest $request): JsonResponse
    {

        $model = StoreBookAction::run($request->validated());
        return $this->successResponse(BookResource::make($model->load('user','category','publication','media')),
            trans('general.model_has_stored_successfully', ['model' => trans('book.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {

        $data = UpdateBookAction::run($book, $request->validated());
        return $this->successResponse(BookResource::make($data->load('user','category','publication','media')),
            trans('general.model_has_updated_successfully', ['model' => trans('book.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        DeleteBookAction::run($book);
        return $this->successResponse('', trans('general.model_has_deleted_successfully', ['model' => trans('book.model')]));
    }

    public function toggle(Book $book, BookRepositoryInterface $repository): JsonResponse
    {
        $book = $repository->toggle($book, 'published');
        return $this->successResponse($book, trans('general.model_has_toggled_successfully',
            ['model' => trans('book.model')]));
    }
    public function addLike(Book $book): bool
    {
        AddLike::run($book);
        return true;
    }
    public function comment(StoreCommentRequest $request, Book $book)
    {
        $data = StoreCommentAction::run($book, $request->validated());
        return $this->successResponse($data,'sss');
    }

}
