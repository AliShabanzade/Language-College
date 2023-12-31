<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\OrderItem\RestoreOrderItemAction;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Actions\OrderItem\StoreOrderItemAction;
use App\Actions\OrderItem\DeleteOrderItemAction;
use App\Actions\OrderItem\UpdateOrderItemAction;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Http\Request;


class OrderItemController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(OrderItem::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(OrderItemRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(OrderItemResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem): JsonResponse
    {
        return $this->successResponse(OrderItemResource::make($orderItem));
    }


    public function store(StoreOrderItemRequest $request): JsonResponse
    {

        $model = StoreOrderItemAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('orderItem.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem): JsonResponse
    {

        $data = UpdateOrderItemAction::run($orderItem, $request->validated());

        return $this->successResponse(OrderItemResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('orderItem.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem): JsonResponse
    {
        DeleteOrderItemAction::run($orderItem);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('orderItem.model')]));
    }

    public function restore(Request $request): JsonResponse
    {
        $orderItem =OrderItem::onlyTrashed()->findOrFail($request->id);
        $this->authorize('restore',$orderItem );

        $restored = RestoreOrderItemAction::run($orderItem);

        if ($restored) {
            return $this->successResponse('', trans('general.model_has_restored_successfully', ['model' => trans('orderItem.model')]));
        } else {
            return $this->errorResponse(trans('general.model_restore_failed'));
        }
    }
}
