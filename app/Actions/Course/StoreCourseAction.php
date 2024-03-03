<?php

namespace App\Actions\Course;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Course;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCourseAction
{
    use AsAction;

    public function __construct(private readonly CourseRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Course
    {
        return DB::transaction(function () use ($payload) {
                 $model=$this->repository->store($payload);
                 SetTranslationAction::run($model,$payload['translations']);
                 return $model->load(['translations']);
        });
    }
}
