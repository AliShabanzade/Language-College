<?php

namespace App\Actions\User;

use App\Models\SmsToken;
use App\Models\User;
use App\Repositories\SmsToken\SmsTokenRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\HasUser;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyCodeAction
{
    use AsAction;
    use  HasUser;


    public function __construct(public SmsTokenRepositoryInterface $repository)
    {

    }


    public function handle($optUser): SmsToken
    {
//        $optUser->user()->update([
//            'mobile_verify_at' => carbon::now()
//        ]);
         $this->repository->update($optUser,[
             'used' => true
         ]);
//        $optUser->update([
//            'used' => true
//        ]);

        return $optUser;

    }


}
