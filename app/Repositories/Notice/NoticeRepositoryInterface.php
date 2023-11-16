<?php

namespace App\Repositories\Notice;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Notice;

interface NoticeRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Notice;
}
