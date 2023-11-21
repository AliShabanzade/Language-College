<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function toggle($model)
    {
        $model->block = !$model->block;
        $model->save();
        return $model;
    }
}
