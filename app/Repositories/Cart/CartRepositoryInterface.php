<?php

namespace App\Repositories\Cart;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Cart;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Cart;
}
