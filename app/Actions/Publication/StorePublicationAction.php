<?php

namespace App\Actions\Publication;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Publication;
use App\Repositories\Publication\PublicationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StorePublicationAction
{
    use AsAction;

    public function __construct(private readonly PublicationRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Publication
    {

        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SetTranslationAction::run($model, $payload['translations']);
            return $model;
        });
    }
}
