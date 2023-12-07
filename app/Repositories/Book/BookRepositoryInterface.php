<?php

namespace App\Repositories\Book;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Book;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Book;

    public function subtractBookInventory($bookId, $quantity);


}
