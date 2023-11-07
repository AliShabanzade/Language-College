<?php

namespace App\Actions\User;

use App\Repositories\ActivationCode\ActivationCodeRepository;
use App\Repositories\SmsConfig\SmsConfigRepository;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class SendSmsCodeAction
{

    use AsAction;


    public function __construct(
        private readonly ActivationCodeRepository $activationCodeRepository,
        private readonly SmsConfigRepository      $smsConfigRepository,
        private readonly UserRepository           $userRepository
    )
    {
    }

    /**
     * Generate a six digits code
     *
     * //     * @param int $codeLength
     * //     * @return string
     * @throws \Exception
     */
    public function generateCode(int $codeLength = 4):int
    {
        $max = 10 ** $codeLength;
        $min = $max / 10 - 1;
        return random_int($min, $max);
    }


    public function handle($mobile_number)
    {
        $sms_config = $this->smsConfigRepository->query()->first();

        if ($sms_config) {

            $code = $this->generateCode();

            $text = ". کد تایید شما$code
             میباشد
            ";
            $data = [
                'name' => $sms_config->name,
                'username' => $sms_config->username,
                'password' => $sms_config->password,
                'to' => $mobile_number,
                'text' => $text,
            ];

            // Send information to the SMS panel
            // $sms = (new Sms())->send($data);
            // Update the user's code only if the mobile number belongs to the user
            $user = $this->userRepository->findByMobile($mobile_number);
            $dataActivation = [
                "code" => $code,
                "user_id" => $user->id,
                "expire_at" => Carbon::now()->addMinute(5),
            ];
            $this->activationCodeRepository->store($dataActivation);
            //todo send sms
            return true;
        }
        return false;

    }
}
