<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Actions\Ticket\StoreTicketAction;
use App\Actions\Ticket\DeleteTicketAction;
use App\Actions\Ticket\UpdateTicketAction;
use App\Repositories\Ticket\TicketRepositoryInterface;


class TicketController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Ticket::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TicketRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(TicketResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): JsonResponse
    {
        return $this->successResponse(TicketResource::make($ticket));
    }


    public function store(StoreTicketRequest $request): JsonResponse
    {
        $model = StoreTicketAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('ticket.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket): JsonResponse
    {
        $data = UpdateTicketAction::run($ticket, $request->all());
        return $this->successResponse(TicketResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('ticket.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket): JsonResponse
    {
        DeleteTicketAction::run($ticket);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('ticket.model')]));
    }
}
