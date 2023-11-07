<?php

namespace App\Actions\User;

use App\Models\ActivationCode;
use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Traits\HasUser;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCodeAction
{
    use AsAction;
    use  HasUser;

    public function __construct(public ActivationCodeRepository $repository)
    {
    }

    public function handle($otpUser): ActivationCode
    {
        $this->repository->update($otpUser, [
            'used' => true
        ]);
        return $otpUser;
    }
}
