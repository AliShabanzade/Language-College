<?php

namespace App\Actions\Opinion;

use App\Models\Opinion;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOpinionAction
{
    use AsAction;

    public function __construct(private readonly OpinionRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Opinion
    {
        return DB::transaction(function () use ($payload) {
            $payload['user_id']= auth()->id();
            return $this->repository->store($payload);
        });
    }
}
