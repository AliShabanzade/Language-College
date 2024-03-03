<?php

namespace App\Repositories\Session;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Session;

interface SessionRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Session;
}
