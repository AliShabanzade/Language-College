<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUserAction
{
    use AsAction;

    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }


    /**
     * @param $eloquent
     * @param array{name:string,mobile_number:string,email:string} $payload
     * @return User
     */
    public function handle($eloquent, array $payload): User
    {
        $this->repository->update($eloquent, $payload);
        return $eloquent;
    }
}
