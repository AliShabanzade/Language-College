<?php

namespace App\Actions\View;

use App\Models\View;
use App\Repositories\View\ViewRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteViewAction
{
    use AsAction;

    public function __construct(public readonly ViewRepositoryInterface $repository)
    {
    }

    public function handle(View $view): bool
    {
        return DB::transaction(function () use ($view) {
            return $this->repository->delete($view);
        });
    }
}
