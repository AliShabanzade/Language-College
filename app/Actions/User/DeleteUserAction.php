<?php

namespace App\Actions\User;

use App\Repositories\User\UserRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUserAction
{
    use AsAction;

    public function __construct(public readonly UserRepositoryInterface $repository)
    {
    }

    public function handle($user):bool
    {
       return $this->repository->delete($user);
    }
}
