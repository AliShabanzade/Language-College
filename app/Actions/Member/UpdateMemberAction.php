<?php

namespace App\Actions\Member;

use App\Enums\PermissionEnum;
use App\Models\Member;
use App\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateMemberAction
{
    use AsAction;

    public function __construct(private readonly MemberRepositoryInterface $repository)
    {
    }


    /**
     * @param Member                                          $member
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Member
     */
    public function handle(Member $member, array $payload): Member
    {
        return DB::transaction(function () use ($member, $payload) {
            $member->update($payload);
            return $member;
        });
    }
}
