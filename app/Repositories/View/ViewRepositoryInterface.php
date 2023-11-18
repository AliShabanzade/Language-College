<?php

namespace App\Repositories\View;

use App\Repositories\BaseRepositoryInterface;
use App\Models\View;

interface ViewRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): View;
}
