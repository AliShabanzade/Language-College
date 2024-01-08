<?php

namespace App\Repositories\SmsConfig;

use App\Models\SmsConfig;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SmsConfigRepository extends BaseRepository implements SmsConfigRepositoryInterface
{
    public function __construct(SmsConfig $model)
    {
        parent::__construct($model);
    }

    public function getModel(): SmsConfig
    {
        return parent::getModel(); 
    }


    public function query(array $payload = []): Builder
    {
        $data = parent::query($payload)->where('status', 'enable');
        return $data;

    }

    public function getActive(): SmsConfig|null
    {   
        return $this->getModel()->first();
    }
}
