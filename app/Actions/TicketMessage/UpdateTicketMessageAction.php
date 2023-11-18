<?php

namespace App\Actions\TicketMessage;

use App\Enums\PermissionEnum;
use App\Models\TicketMessage;
use App\Repositories\TicketMessage\TicketMessageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTicketMessageAction
{
    use AsAction;

    public function __construct(private readonly TicketMessageRepositoryInterface $repository)
    {
    }


    /**
     * @param TicketMessage                                          $ticketMessage
     * @param array{name:string,mobile:string,email:string} $payload
     * @return TicketMessage
     */
    public function handle(TicketMessage $ticketMessage, array $payload): TicketMessage
    {
        return DB::transaction(function () use ($ticketMessage, $payload) {
            $ticketMessage->update($payload);
            return $ticketMessage;
        });
    }
}
