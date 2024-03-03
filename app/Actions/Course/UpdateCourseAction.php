<?php

namespace App\Actions\Course;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Course;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCourseAction
{
    use AsAction;

    public function __construct(private readonly CourseRepositoryInterface $repository)
    {
    }


    /**
     * @param Course                                          $course
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Course
     */
    public function handle(Course $course, array $payload): Course
    {
        return DB::transaction(function () use ($course, $payload) {
            $model=$this->repository->update($course,$payload);
            SetTranslationAction::run($model,$payload['translations']);
            return $model->load('translations');
        });
    }
}
