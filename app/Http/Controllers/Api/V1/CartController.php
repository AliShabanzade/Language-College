<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Resources\CartResource;
use App\Actions\Cart\StoreCartAction;
use App\Actions\Cart\DeleteCartAction;
use App\Actions\Cart\UpdateCartAction;
use App\Repositories\Cart\CartRepositoryInterface;
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
        if ($roles->contains('name', 'admin') || $roles->contains('name')) {
            return $this->successResponse(CartResource::collection($repository->paginate()));
        } else {

            $shoppingCart = $repository->userOwnCart($user)->paginate();
            return $this->successResponse(CartResource::collection($shoppingCart));
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart): JsonResponse
    {
        return $this->successResponse(CartResource::make($cart->load('user')));
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
