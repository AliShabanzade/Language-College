<?php

namespace App\Actions\Bok;

use App\Models\Bok;
use App\Repositories\Bok\BokRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreBokAction
{
    use AsAction;

    public function __construct(private readonly BokRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Bok
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
