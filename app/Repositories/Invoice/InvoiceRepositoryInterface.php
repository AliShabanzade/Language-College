<?php

namespace App\Repositories\Invoice;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Invoice;

interface InvoiceRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Invoice;
}
