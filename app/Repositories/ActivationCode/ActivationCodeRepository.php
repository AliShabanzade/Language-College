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

    public function otpUser($code, $user)
    {
//        dd($code);
//        dd(  $this->query()
//        ->where('code', $code)
////        ->active()
//        ->where('user_id', $user->id)
//        ->where('expire_at', '>', Carbon::now())
//        ->first());
        return $this->query()
            ->where('code', $code)
            ->active()
            ->where('user_id', $user->id)
            ->where('expire_at', '>', Carbon::now())
            ->first();
    }
}
