<?php

namespace App\Actions\Classroom;

use App\Models\Classroom;
use App\Repositories\Classroom\ClassroomRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreClassroomAction
{
    use AsAction;

    public function __construct(private readonly ClassroomRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Classroom
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
