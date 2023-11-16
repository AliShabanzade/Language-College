<?php

namespace App\Repositories\Bok;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Bok;

interface BokRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Bok;
}
