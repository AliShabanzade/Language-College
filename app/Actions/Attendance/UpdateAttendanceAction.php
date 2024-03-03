<?php

namespace App\Actions\Attendance;

use App\Enums\PermissionEnum;
use App\Models\Attendance;
use App\Repositories\Attendance\AttendanceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateAttendanceAction
{
    use AsAction;

    public function __construct(private readonly AttendanceRepositoryInterface $repository)
    {
    }


    /**
     * @param Attendance                                          $attendance
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Attendance
     */
    public function handle(Attendance $attendance, array $payload): Attendance
    {
        return DB::transaction(function () use ($attendance, $payload) {
            $attendance->update($payload);
            return $attendance;
        });
    }
}
