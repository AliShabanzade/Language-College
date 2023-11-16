<?php

namespace App\Repositories\Invoice;

use App\Models\Invoice;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface
{
    public function __construct(Invoice $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Invoice
   {
       return parent::getModel();
   }
}
