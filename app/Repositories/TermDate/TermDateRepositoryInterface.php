<?php

namespace App\Repositories\TermDate;

use App\Repositories\BaseRepositoryInterface;
use App\Models\TermDate;

interface TermDateRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): TermDate;
}
