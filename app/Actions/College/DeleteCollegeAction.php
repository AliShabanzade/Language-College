<?php

namespace App\Actions\College;

use App\Models\College;
use App\Repositories\College\CollegeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCollegeAction
{
    use AsAction;

    public function __construct(public readonly CollegeRepositoryInterface $repository)
    {
    }

    public function handle(College $college): bool
    {
        return DB::transaction(function () use ($college) {
            return $this->repository->delete($college);
        });
    }
}
