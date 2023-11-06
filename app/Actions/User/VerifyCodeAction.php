<?php

namespace App\Actions\User;

use App\Models\ActivationCode;
use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Traits\HasUser;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyCodeAction
{
    use AsAction;
    use  HasUser;


    public function __construct(public ActivationCodeRepository $repository)
    {

    }


    public function handle($otpUser): ActivationCode
    {
//        $optUser->user()->update([
//            'mobile_verify_at' => carbon::now()
//        ]);
         $this->repository->update($otpUser,[
             'used' => true
         ]);
//        $optUser->update([
//            'used' => true
//        ]);

        return $otpUser;

    }


}
