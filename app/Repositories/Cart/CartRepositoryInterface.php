<?php

namespace App\Repositories\Cart;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Cart;

    public function userOwnCart($user);


}
