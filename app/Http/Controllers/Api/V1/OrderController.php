<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Order\RestoreOrderAction;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Actions\Order\StoreOrderAction;
use App\Actions\Order\DeleteOrderAction;
use App\Actions\Order\UpdateOrderAction;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;


class OrderController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Order::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(OrderRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(OrderResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): JsonResponse
    {
        return $this->successResponse(OrderResource::make($order));
    }


    public function store(StoreOrderRequest $request): JsonResponse
    {
        $model = StoreOrderAction::run($request->validated());
        return $this->successResponse(OrderResource::make($model), trans('general.model_has_stored_successfully', ['model' => trans('order.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        $data = UpdateOrderAction::run($order, $request->validated());
        return $this->successResponse(OrderResource::make($data), trans('general.model_has_updated_successfully', ['model' => trans('order.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): JsonResponse
    {

        DeleteOrderAction::run($order);
        return $this->successResponse('', trans('general.model_has_deleted_successfully', ['model' => trans('order.model')]));
    }


    public function restore(Request $request): JsonResponse
    {
        $order=Order::onlyTrashed()->findOrFail($request->id);
        $this->authorize('restore',$order );

        $restored = RestoreOrderAction::run($order);

        if ($restored) {
            return $this->successResponse('', trans('general.model_has_restored_successfully', ['model' => trans('order.model')]));
        } else {
            return $this->errorResponse(trans('general.model_restore_failed'));
        }
    }

}
