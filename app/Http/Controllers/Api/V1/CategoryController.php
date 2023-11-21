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
use Illuminate\Http\Request;


class CategoryController extends ApiBaseController
{

    public function __construct()
    {
        //$this->middleware('auth:api')->except('index','show');
        //$this->authorizeResource(Category::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,CategoryRepositoryInterface $repository): JsonResponse
    {

        if(isset($request['children']) && !isset($request['parent'])){
            $model= $repository->get($request->all());
        }elseif (isset($request['parent']) && !isset($request['children'])){
            $model= $repository->get($request->all());
        }elseif (isset($request['parent']) && isset($request['children'])){
            $model= $repository->get($request->all());
        }else{
            $model= $repository->paginate($request->input('limit',5),$request->all());
        }
        return $this->successResponse(CategoryResource::collection($model));

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
       $this->authorize('create', Category::class);
        $model = StoreCategoryAction::run($request->validated());

        return $this->successResponse(CategoryResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('category.model')]));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        //$this->authorize('update', $category);
        $data = UpdateCategoryAction::run($category, $request->validated());
        return $this->successResponse(CategoryResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('category.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $this->authorize('delete', $category);
        DeleteCategoryAction::run($category);
        return $this->successResponse('',
            trans('general.model_has_deleted_successfully',['model'=>trans('category.model')]));
    }

    public function toggle(Category $category, CategoryRepositoryInterface $repository): JsonResponse
    {
        $category = $repository->toggle($category, 'published');
        return $this->successResponse($category, trans('general.model_has_toggled_successfully',
            ['model' => trans('category.model')]));
    }
}
