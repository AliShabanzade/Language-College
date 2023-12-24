<?php

namespace App\Actions\User;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUserAction
{
    use AsAction;

    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }


    /**
     * @param User                                          $user
     * @param array{name:string,mobile:string,email:string} $payload
     * @return User
     */
    public function handle(User $user, array $payload): User
    {
        return DB::transaction(function () use ($user, $payload) {

            $this->repository->update($user, $payload);

            if (request()->hasFile('avatar')) {
                $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
            }

            if (request()->hasFile('cart_melli')) {
                $user->addMediaFromRequest('cart_melli')->toMediaCollection('cart_melli');
            }

            if (request()->hasFile('shenasname')) {
                $user->addMediaFromRequest('shenasname')->toMediaCollection('shenasname');
            }

            if (request()->hasFile('cover')) {
//                $user->clearMediaCollection('cover');
                $user->addMediaFromRequest('cover')->toMediaCollection('cover');
            }

            return $user;
        });
    }
}
