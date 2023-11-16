<?php

namespace App\Actions\User;

use App\Models\ActivationCode;
use App\Models\User;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\SmsConfig\SmsConfigRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SendSmsCodeAction
{
    use AsAction;

    public function __construct(
        private readonly ActivationCodeRepositoryInterface $activationCodeRepository,
        private readonly SmsConfigRepositoryInterface $smsConfigRepository,
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @param int $codeLength
     * @return int
     * @throws Exception
     */
    public function generateCode(int $codeLength = 4): int
    {
        $max = 10 ** $codeLength;
        $min = $max / 10 - 1;
        return random_int($min, $max);
    }

    /**
     * @throws Exception
     */
    public function handle(User $user): ActivationCode
    {
        if (!$this->smsConfigRepository->getActive()) {
            abort(ResponseAlias::HTTP_NOT_FOUND,trans('smsConfig.sms_panel_not_active'));
        }
        $code = $this->generateCode();
        $user = $this->userRepository->find(value: $user->mobile, field: 'mobile', firstOrFail: true);
        /** @var ActivationCode $model */
        $model = $this->activationCodeRepository->store([
            "code" => $code,
            "user_id" => $user->id,
            "expire_at" => Carbon::now()->addMinutes(5),
        ]);
        // todo: send sms
        return $model;
    }
}
