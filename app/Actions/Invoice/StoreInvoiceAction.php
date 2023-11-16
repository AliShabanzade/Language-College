<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreInvoiceAction
{
    use AsAction;

    public function __construct(private readonly InvoiceRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Invoice
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
