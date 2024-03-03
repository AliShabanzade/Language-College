<?php

namespace App\Actions\Classroom;

use App\Enums\PermissionEnum;
use App\Models\Classroom;
use App\Repositories\Classroom\ClassroomRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateClassroomAction
{
    use AsAction;

    public function __construct(private readonly ClassroomRepositoryInterface $repository)
    {
    }


    /**
     * @param Classroom                                          $classroom
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Classroom
     */
    public function handle(Classroom $classroom, array $payload): Classroom
    {
        return DB::transaction(function () use ($classroom, $payload) {
            $classroom->update($payload);
            return $classroom;
        });
    }
}
