<?php

namespace App\Repositories\Faq;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Faq;

interface FaqRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Faq;
}
