<?php

namespace App\Actions\College;

use App\Actions\Translation\SetTranslationAction;
use App\Models\College;
use App\Repositories\College\CollegeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCollegeAction
{
    use AsAction;

    public function __construct(private readonly CollegeRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): College
    {
        return DB::transaction(function () use ($payload) {
            $model= $this->repository->store($payload);
            SetTranslationAction::run($model, $payload['translations']);
            return $model->load('translations');
        });
    }
}
