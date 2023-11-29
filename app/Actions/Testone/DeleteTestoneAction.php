<?php

namespace App\Actions\Testone;

use App\Models\Testone;
use App\Repositories\Testone\TestoneRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTestoneAction
{
    use AsAction;

    public function __construct(public readonly TestoneRepositoryInterface $repository)
    {
    }

    public function handle(Testone $testone): bool
    {
        return DB::transaction(function () use ($testone) {
            return $this->repository->delete($testone);
        });
    }
}
