<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Actions\Invoice\StoreInvoiceAction;
use App\Actions\Invoice\DeleteInvoiceAction;
use App\Actions\Invoice\UpdateInvoiceAction;
use App\Repositories\Invoice\InvoiceRepositoryInterface;


class InvoiceController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Invoice::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(InvoiceRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(InvoiceResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): JsonResponse
    {
        return $this->successResponse(InvoiceResource::make($invoice));
    }


    public function store(StoreInvoiceRequest $request): JsonResponse
    {
        $model = StoreInvoiceAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('invoice.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice): JsonResponse
    {
        $data = UpdateInvoiceAction::run($invoice, $request->all());
        return $this->successResponse(InvoiceResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('invoice.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): JsonResponse
    {
        DeleteInvoiceAction::run($invoice);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('invoice.model')]));
    }
}
