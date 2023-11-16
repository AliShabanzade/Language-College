<?php

namespace App\Repositories\Ticket;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Ticket;

interface TicketRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Ticket;
}
