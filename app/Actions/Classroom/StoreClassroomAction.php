<?php

namespace App\Actions\Classroom;

use App\Actions\Translation\SetTranslationAction;
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
            $model = $this->repository->store($payload);
            SetTranslationAction::run($model, $payload['translations']);
            return $model->load('translations','course','term','term_date','college');
        });
    }
}
