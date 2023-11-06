<?php

namespace App\Repositories\User;

use App\Repositories\BaseReposirotyInterface;

interface UserRepositoryInterface extends BaseReposirotyInterface
{
    public function toggle($model);

    public function findByMobile(int $payload);

}
