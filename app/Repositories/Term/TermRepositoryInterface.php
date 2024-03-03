<?php

namespace App\Repositories\Term;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Term;

interface TermRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Term;
}
