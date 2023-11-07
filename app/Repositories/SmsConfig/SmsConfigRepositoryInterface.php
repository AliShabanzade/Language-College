<?php

namespace App\Repositories\SmsConfig;

use App\Models\SmsConfig;
use App\Repositories\BaseReposirotyInterface;
use App\Repositories\BaseRepositoryInterface;

interface SmsConfigRepositoryInterface extends BaseRepositoryInterface
{
    public function getActive():SmsConfig|null;

}
