<?php

namespace App\Actions\Publication;

use App\Models\Publication;
use App\Repositories\Publication\PublicationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeletePublicationAction
{
    use AsAction;

    public function __construct(public readonly PublicationRepositoryInterface $repository)
    {
    }

    public function handle(Publication $publication): bool
    {
        return DB::transaction(function () use ($publication) {
            return $this->repository->delete($publication);
        });
    }
}
