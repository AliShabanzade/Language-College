<?php

namespace App\Actions\TermDate;

use App\Actions\Translation\SetTranslationAction;
use App\Models\TermDate;
use App\Repositories\TermDate\TermDateRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTermDateAction
{
    use AsAction;

    public function __construct(private readonly TermDateRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): TermDate
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SetTranslationAction::run($model, $payload['translations']);
            return $model->load('translations');
        });
    }
}
