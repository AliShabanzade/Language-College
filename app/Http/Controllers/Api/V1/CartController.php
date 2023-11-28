<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Resources\CartResource;
use App\Actions\Cart\StoreCartAction;
use App\Actions\Cart\DeleteCartAction;
use App\Actions\Cart\UpdateCartAction;
use App\Repositories\Cart\CartRepositoryInterface;


class CartController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Cart::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CartRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(CartResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart): JsonResponse
    {
        return $this->successResponse(CartResource::make($cart));
    }


    public function store(StoreCartRequest $request): JsonResponse
    {
        $model = StoreCartAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully', ['model' => trans('cart.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart): JsonResponse
    {
        $data = UpdateCartAction::run($cart, $request->all());
        return $this->successResponse(CartResource::make($data), trans('general.model_has_updated_successfully', ['model' => trans('cart.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart): JsonResponse
    {
        DeleteCartAction::run($cart);
        return $this->successResponse('', trans('general.model_has_deleted_successfully', ['model' => trans('cart.model')]));
    }
}
