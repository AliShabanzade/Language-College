<?php

namespace App\Actions\Opinion;

use App\Models\Opinion;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteOpinionAction
{
    use AsAction;

    public function __construct(public readonly OpinionRepositoryInterface $repository)
    {
    }

    public function handle(Opinion $opinion): bool
    {
        return DB::transaction(function () use ($opinion) {
            return $this->repository->delete($opinion);
        });
    }
}
