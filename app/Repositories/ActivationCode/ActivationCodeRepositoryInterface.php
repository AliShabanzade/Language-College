<?php

namespace App\Repositories\ActivationCode;


use App\Models\ActivationCode;
use App\Models\User;
use App\Repositories\BaseRepositoryInterface;

interface ActivationCodeRepositoryInterface extends BaseRepositoryInterface
{
    public function checkCode(User $user,string $code): ActivationCode|null;

    public function useCode(ActivationCode $activationCode): ActivationCode;
}
