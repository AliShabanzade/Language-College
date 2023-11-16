<?php

namespace App\Repositories\TicketMessage;

use App\Models\TicketMessage;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class TicketMessageRepository extends BaseRepository implements TicketMessageRepositoryInterface
{
    public function __construct(TicketMessage $model)
    {
        parent::__construct($model);
    }

   public function getModel(): TicketMessage
   {
       return parent::getModel();
   }
}
