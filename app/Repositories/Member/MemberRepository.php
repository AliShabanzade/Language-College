<?php

namespace App\Repositories\Member;

use App\Models\Member;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class MemberRepository extends BaseRepository implements MemberRepositoryInterface
{
    public function __construct(Member $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Member
   {
       return parent::getModel();
   }
}
