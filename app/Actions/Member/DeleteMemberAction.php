<?php

namespace App\Actions\Member;

use App\Models\Member;
use App\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteMemberAction
{
    use AsAction;

    public function __construct(public readonly MemberRepositoryInterface $repository)
    {
    }

    public function handle(Member $member): bool
    {
        return DB::transaction(function () use ($member) {
            return $this->repository->delete($member);
        });
    }
}
