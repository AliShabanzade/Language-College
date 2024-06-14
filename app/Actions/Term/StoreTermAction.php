<?php

namespace App\Actions\Term;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Term;
use App\Repositories\Term\TermRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTermAction
{
    use AsAction;

    public function __construct(private readonly TermRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Term
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SetTranslationAction::run($model, $payload['translations']);
            return $model->load('translations','course');
        });
    }
}
