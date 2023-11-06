<?php

namespace App\Repositories\ActivationCode;

use App\Models\ActivationCode;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActivationCodeRepository extends BaseRepository implements ActivationCodeRepositoryInterface
{
public function __construct(ActivationCode $model)
{
    parent::__construct($model);

}

    public function otpUser ($payload ,$user){
       return $this->query()->where('code', $payload)
           ->where('user_id',$user->id)
           ->where('verify_at','>',Carbon::now());
}
}
