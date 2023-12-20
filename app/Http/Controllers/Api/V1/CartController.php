<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Cart\DeleteCartAction;
use App\Actions\Cart\StoreCartAction;
use App\Http\Requests\StoreCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Http\JsonResponse;


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
        return $this->successResponseWithAdditional(
            CartResource::collection($repository->paginate()),
            additional: [
                'total' => $repository->getTotal()
            ]);
    }

    public function store(StoreCartRequest $request): JsonResponse
    {
        $model = StoreCartAction::run($request->validated());
        return $this->successResponse(CartResource::make($model), trans('general.model_has_stored_successfully', ['model' => trans('cart.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart): JsonResponse
    {
        DeleteCartAction::run($cart);
        return $this->successResponse(message: trans('general.model_has_deleted_successfully', ['model' => trans('cart.model')]));
    }

//    public function checkOut()
//    {
//        $order = CheckoutCartAction::run();
//        if ($order) {
//            return $this->successResponse(OrderResource::make($order), trans('general.model_has_stored_successfully', ['model' => trans('order.model')]));
//        }
//        return $this->errorResponse(trans('checkout.user_shopping_cart_has_no_products_that_have_been_checked_out'), 400);
//    }
}
