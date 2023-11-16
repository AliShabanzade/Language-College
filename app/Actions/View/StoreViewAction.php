<?php

namespace App\Actions\View;

use App\Models\View;
use App\Repositories\View\ViewRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreViewAction
{
    use AsAction;

    public function __construct(private readonly ViewRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): View
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
