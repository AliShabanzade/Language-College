<?php

namespace App\Actions\Bok;

use App\Models\Bok;
use App\Repositories\Bok\BokRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteBokAction
{
    use AsAction;

    public function __construct(public readonly BokRepositoryInterface $repository)
    {
    }

    public function handle(Bok $bok): bool
    {
        return DB::transaction(function () use ($bok) {
            return $this->repository->delete($bok);
        });
    }
}
