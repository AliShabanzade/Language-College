<?php

namespace App\Actions\Invoice;

use App\Enums\PermissionEnum;
use App\Models\Invoice;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateInvoiceAction
{
    use AsAction;

    public function __construct(private readonly InvoiceRepositoryInterface $repository)
    {
    }


    /**
     * @param Invoice                                          $invoice
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Invoice
     */
    public function handle(Invoice $invoice, array $payload): Invoice
    {
        return DB::transaction(function () use ($invoice, $payload) {
            $invoice->update($payload);
            return $invoice;
        });
    }
}
