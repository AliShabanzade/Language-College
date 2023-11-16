<?php

namespace App\Actions\Ticket;

use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTicketAction
{
    use AsAction;

    public function __construct(public readonly TicketRepositoryInterface $repository)
    {
    }

    public function handle(Ticket $ticket): bool
    {
        return DB::transaction(function () use ($ticket) {
            return $this->repository->delete($ticket);
        });
    }
}
