<?php

namespace App\Actions\Ticket;

use App\Enums\PermissionEnum;
use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTicketAction
{
    use AsAction;

    public function __construct(private readonly TicketRepositoryInterface $repository)
    {
    }


    /**
     * @param Ticket                                          $ticket
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Ticket
     */
    public function handle(Ticket $ticket, array $payload): Ticket
    {
        return DB::transaction(function () use ($ticket, $payload) {
            $ticket->update($payload);
            return $ticket;
        });
    }
}
