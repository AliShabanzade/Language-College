<?php

namespace App\Actions\Classroom;

use App\Models\Classroom;
use App\Repositories\Classroom\ClassroomRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteClassroomAction
{
    use AsAction;

    public function __construct(public readonly ClassroomRepositoryInterface $repository)
    {
    }

    public function handle(Classroom $classroom): bool
    {
        return DB::transaction(function () use ($classroom) {
            return $this->repository->delete($classroom);
        });
    }
}
