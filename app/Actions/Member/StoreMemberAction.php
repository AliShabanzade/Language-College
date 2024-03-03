<?php

namespace App\Actions\Member;

use App\Models\Member;
use App\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreMemberAction
{
    use AsAction;

    public function __construct(private readonly MemberRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Member
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
