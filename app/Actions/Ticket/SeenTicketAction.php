<?php

namespace App\Actions\Ticket;

use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class SeenTicketAction
{
    use AsAction;

    public function __construct(private readonly TicketRepositoryInterface $repository)
    {
    }

    public function handle(Ticket $ticket): Ticket
    {
        if (!$ticket->status){
            return $this->repository->toggle($ticket, "status");
        }
        return $ticket;
    }
}
