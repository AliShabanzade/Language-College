<?php

namespace App\Actions\Session;

use App\Models\Session;
use App\Models\User;
use App\Repositories\Session\SessionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class ToggleSessionAction
{
    use AsAction;

    public function __construct(private readonly SessionRepositoryInterface $repository)
    {
    }

    public function handle(Session $session): Session
    {
        return DB::transaction(function () use ($session) {
            return $this->repository->toggle($session,'status');
        });
    }
}
