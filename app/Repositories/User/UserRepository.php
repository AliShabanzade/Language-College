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

    public function findByMobile(int $payload): Builder
    {
        return $this->query()->where('mobile_number', $payload);

    }

    public function toggle($model)
    {
        $model->block = !$model->block;
        $model->save();
        return $model;
    }

}
