<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Book\DeleteBookAction;
use App\Actions\Book\StoreBookAction;
use App\Actions\Book\UpdateBookAction;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use Illuminate\Http\JsonResponse;


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
    public function show(Book $book)
    {

        return $this->successResponse(BookResource::make($book->load(['category','user'])));
    }


    public function store(StoreBookRequest $request): JsonResponse
    {

        $model = StoreBookAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('book.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {

        $data = UpdateBookAction::run($book, $request->validated());
        return $this->successResponse(BookResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('book.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        DeleteBookAction::run($book);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('book.model')]));
    }

    public function toggle(Book $book, BookRepositoryInterface $repository): JsonResponse
    {
        $book = $repository->toggle($book, 'published');
        return $this->successResponse($book, trans('general.model_has_toggled_successfully',
            ['model' => trans('book.model')]));
    }
}
