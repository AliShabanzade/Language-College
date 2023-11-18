<?php

namespace App\Repositories\TicketMessage;

use App\Repositories\BaseRepositoryInterface;
use App\Models\TicketMessage;

interface TicketMessageRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): TicketMessage;
}
