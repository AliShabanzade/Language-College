<?php

namespace App\Repositories\Publication;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Publication;

interface PublicationRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Publication;
}
