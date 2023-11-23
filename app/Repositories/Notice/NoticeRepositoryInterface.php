<?php

namespace App\Repositories\Notice;

use App\Models\Notice;
use App\Repositories\BaseRepositoryInterface;

interface NoticeRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Notice;
}
