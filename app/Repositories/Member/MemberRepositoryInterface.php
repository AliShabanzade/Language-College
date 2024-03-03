<?php

namespace App\Repositories\Member;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Member;

interface MemberRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Member;
}
