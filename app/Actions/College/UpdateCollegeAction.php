<?php

namespace App\Actions\College;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\College;
use App\Repositories\College\CollegeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCollegeAction
{
    use AsAction;

    public function __construct(private readonly CollegeRepositoryInterface $repository)
    {
    }


    /**
     * @param College                                          $college
     * @param array{name:string,mobile:string,email:string} $payload
     * @return College
     */
    public function handle(College $college, array $payload): College
    {
        return DB::transaction(function () use ($college, $payload) {

            $model=$this->repository->update($college,$payload);
            SetTranslationAction::run($model,$payload['translations']);
            return $model->load('translations');
        });
    }
}
