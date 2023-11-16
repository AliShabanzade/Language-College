<?php

namespace App\Actions\TicketMessage;

use App\Models\TicketMessage;
use App\Repositories\TicketMessage\TicketMessageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTicketMessageAction
{
    use AsAction;

    public function __construct(private readonly TicketMessageRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): TicketMessage
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
