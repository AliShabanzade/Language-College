<?php

namespace App\Repositories\User;


use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByMobile(int $mobile): User
    {
        return $this->query()->where('mobile_number', $mobile)->first();

    }

    public function toggle($model):User
    {
        $model->block = !$model->block;
        $model->save();
        return $model;
    }

    public function verifyUser(User $user): User
    {
        $user->mobile_verify_at = now();
        $user->save();
        return $user;
    }
}
