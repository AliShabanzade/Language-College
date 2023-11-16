<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteInvoiceAction
{
    use AsAction;

    public function __construct(public readonly InvoiceRepositoryInterface $repository)
    {
    }

    public function handle(Invoice $invoice): bool
    {
        return DB::transaction(function () use ($invoice) {
            return $this->repository->delete($invoice);
        });
    }
}
