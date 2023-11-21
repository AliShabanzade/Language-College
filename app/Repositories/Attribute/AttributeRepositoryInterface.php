<?php

namespace App\Repositories\Attribute;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Attribute;

interface AttributeRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Attribute;
}
