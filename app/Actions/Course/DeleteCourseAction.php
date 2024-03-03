<?php

namespace App\Actions\Course;

use App\Models\Course;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCourseAction
{
    use AsAction;

    public function __construct(public readonly CourseRepositoryInterface $repository)
    {
    }

    public function handle(Course $course): bool
    {
        return DB::transaction(function () use ($course) {
            return $this->repository->delete($course);
        });
    }
}
