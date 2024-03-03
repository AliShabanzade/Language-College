<?php

namespace App\Actions\Session;

use App\Models\Session;
use App\Repositories\Session\SessionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreSessionAction
{
    use AsAction;

    public function __construct(private readonly SessionRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Session
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
