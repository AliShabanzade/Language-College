<?php

namespace App\Actions\TermDate;

use App\Models\TermDate;
use App\Repositories\TermDate\TermDateRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTermDateAction
{
    use AsAction;

    public function __construct(public readonly TermDateRepositoryInterface $repository)
    {
    }

    public function handle(TermDate $termDate): bool
    {
        return DB::transaction(function () use ($termDate) {
            return $this->repository->delete($termDate);
        });
    }
}
