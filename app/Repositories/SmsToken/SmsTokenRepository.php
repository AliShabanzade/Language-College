<?php

namespace App\Repositories\SmsToken;

use App\Models\SmsToken;
use App\Repositories\BaseRepository;

class SmsTokenRepository extends BaseRepository implements SmsTokenRepositoryInterface
{
    public function __construct(SmsToken $model)
    {
        parent::__construct($model);
    }

}
