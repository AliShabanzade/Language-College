<?php

namespace App\Actions\Testone;

use App\Models\Testone;
use App\Repositories\Testone\TestoneRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTestoneAction
{
    use AsAction;

    public function __construct(private readonly TestoneRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Testone
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
