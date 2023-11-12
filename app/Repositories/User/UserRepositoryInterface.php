<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function verifyUser(User $user);
    public function generateToken(User $user): string;
}
