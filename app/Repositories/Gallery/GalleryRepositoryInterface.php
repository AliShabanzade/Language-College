<?php

namespace App\Repositories\Gallery;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Gallery;

interface GalleryRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Gallery;
}
