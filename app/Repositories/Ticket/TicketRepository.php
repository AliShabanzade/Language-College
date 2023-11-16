<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Ticket
   {
       return parent::getModel();
   }
}
