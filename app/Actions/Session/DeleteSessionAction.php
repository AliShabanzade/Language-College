<?php

namespace App\Actions\Session;

use App\Models\Session;
use App\Repositories\Session\SessionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteSessionAction
{
    use AsAction;

    public function __construct(public readonly SessionRepositoryInterface $repository)
    {
    }

    public function handle(Session $session): bool
    {
        return DB::transaction(function () use ($session) {
            return $this->repository->delete($session);
        });
    }
}
