<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\TicketMessage;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTicketMessageRequest;
use App\Http\Requests\StoreTicketMessageRequest;
use App\Http\Resources\TicketMessageResource;
use App\Actions\TicketMessage\StoreTicketMessageAction;
use App\Actions\TicketMessage\DeleteTicketMessageAction;
use App\Actions\TicketMessage\UpdateTicketMessageAction;
use App\Repositories\TicketMessage\TicketMessageRepositoryInterface;


class TicketMessageController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(TicketMessage::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TicketMessageRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(TicketMessageResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketMessage $ticketMessage): JsonResponse
    {
        return $this->successResponse(TicketMessageResource::make($ticketMessage));
    }


    public function store(StoreTicketMessageRequest $request): JsonResponse
    {
        $model = StoreTicketMessageAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('ticketMessage.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketMessageRequest $request, TicketMessage $ticketMessage): JsonResponse
    {
        $data = UpdateTicketMessageAction::run($ticketMessage, $request->all());
        return $this->successResponse(TicketMessageResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('ticketMessage.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketMessage $ticketMessage): JsonResponse
    {
        DeleteTicketMessageAction::run($ticketMessage);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('ticketMessage.model')]));
    }
}
