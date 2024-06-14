<?php

namespace App\Actions\Classroom;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\PermissionsEnum;
use App\Enums\TableClassroomFieldTypeEnum;
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
     * @param Classroom $classroom
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Classroom
     */
    public function handle(Classroom $classroom, array $payload): Classroom
    {
        return DB::transaction(function () use ($classroom, $payload) {
            if ($classroom->type === TableClassroomFieldTypeEnum::FINISHED->value) {
                abort('403', trans('classroom.Can_not_update'));
            }
            $model=$this->repository->update($classroom,$payload);
            SetTranslationAction::run($model,$payload['translations']);
            return $model->load('translations','course','term','college');
        });
    }
}
