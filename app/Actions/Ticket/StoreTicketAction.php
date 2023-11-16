<?php

namespace App\Actions\Ticket;

use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTicketAction
{
    use AsAction;

    public function __construct(private readonly TicketRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Ticket
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
