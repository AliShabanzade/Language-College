<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Actions\Category\StoreCategoryAction;
use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Repositories\Category\CategoryRepositoryInterface;


class CategoryController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Category::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(CategoryResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        return $this->successResponse(CategoryResource::make($category));
    }


    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $model = StoreCategoryAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('category.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $data = UpdateCategoryAction::run($category, $request->all());
        return $this->successResponse(CategoryResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('category.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        DeleteCategoryAction::run($category);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('category.model')]));
    }
}
