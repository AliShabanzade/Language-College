<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Actions\Product\StoreProductAction;
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductController extends ApiBaseController
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Product::class);
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(ProductResource::collection($this->productRepository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        return $this->successResponse(ProductResource::make($product));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $model = StoreProductAction::run($request->validated());
        return $this->successResponse($model, 'product successfully created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $data = UpdateProductAction::run($product, $request->all());
        return $this->successResponse(ProductResource::make($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        DeleteProductAction::run($product);
        return $this->successResponse('', 'product has been deleted successfully');
    }
}
