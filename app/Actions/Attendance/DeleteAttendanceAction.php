<?php

namespace App\Actions\Attendance;

use App\Models\Attendance;
use App\Repositories\Attendance\AttendanceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteAttendanceAction
{
    use AsAction;

    public function __construct(public readonly AttendanceRepositoryInterface $repository)
    {
    }

    public function handle(Attendance $attendance): bool
    {
        return DB::transaction(function () use ($attendance) {
            return $this->repository->delete($attendance);
        });
    }
}
