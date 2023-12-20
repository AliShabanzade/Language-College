<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Cart\CheckoutCartAction;
use App\Actions\Cart\DeleteCartAction;
use App\Actions\Cart\StoreCartAction;
use App\Actions\Cart\UpdateCartAction;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserCartResource;
use App\Models\Cart;
use App\Repositories\Cart\CartRepositoryInterface;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


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
        $user = auth()->user();
        $roles = $user->roles;

        if ($roles->pluck('name')->contains('admin')) {
            return $this->successResponse(CartResource::collection($repository->paginate()));
        }

        $shoppingCart = $repository->userOwnCart($user);
        return $this->successResponse(UserCartResource::make($shoppingCart));
    }





    /**
     * Display the specified resource.
     */
    public function show(Cart $cart): JsonResponse
    {
        return $this->successResponse(CartResource::make($cart->load('book')));
    }


    public function store(StoreCartRequest $request): JsonResponse
    {
        $model = StoreCartAction::run($request->validated());
        return $this->successResponse(CartResource::make($model), trans('general.model_has_stored_successfully', ['model' => trans('cart.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart): JsonResponse
    {
//        dd($cart);
        $data = UpdateCartAction::run($cart, $request->validated());
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

    public function checkOut()
//    public function checkOut(CheckoutRequest $request)
    {

//        $order = CheckoutCartAction::run($request->validated());
        $order = CheckoutCartAction::run();
        if ($order) {

            return $this->successResponse(OrderResource::make($order), trans('general.model_has_stored_successfully', ['model' => trans('order.model')]));
        }
        return $this->errorResponse(trans('checkout.user_shopping_cart_has_no_products_that_have_been_checked_out'), 400);
    }
}
