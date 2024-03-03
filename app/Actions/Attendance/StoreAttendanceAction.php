<?php

namespace App\Actions\Attendance;

use App\Models\Attendance;
use App\Repositories\Attendance\AttendanceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreAttendanceAction
{
    use AsAction;

    public function __construct(private readonly AttendanceRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Attendance
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
