<?php

namespace App\Actions\User;

use App\Models\SmsConfig;
use App\Models\SmsToken;
use App\Models\User;
use App\Traits\HasUser;
use Lorisleiva\Actions\Concerns\AsAction;

class SendSmsCodeAction
{

    use AsAction;





//    public function __construct(array $attributes = [])
//    {
//        if (! isset($attributes['code'])) {
//            $attributes['code'] = $this->generateCode();
//        }
//        parent::__construct($attributes);
//    }

    /**
     * Generate a six digits code
     *
    //     * @param int $codeLength
    //     * @return string
     */
    public function generateCode($codeLength = 4)
    {
        $max = pow(10, $codeLength);
        $min = $max / 10 - 1;
        $code = mt_rand($min, $max);
        return $code;
    }

//    public function sendCode()
//    {

//        try {
//            // send code via SMS
//        } catch (\Exception $ex) {
//            return false; //enable to send SMS
//        }
//        return true;
//    }

    public function handle($mobile_number)
    {


        $sms_config  = SmsConfig::query()->where('status','enable')->first();

        if ($sms_config){

             $code = $this->generateCode();

            $encryptedCode = substr(md5($code), 0, 6);

            $text = ". کد تایید شما$encryptedCode
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
            $user = User::where('mobile_number',$mobile_number)->first();

            SmsToken::create([
                "code" => $code,
                "secret_code" => $encryptedCode,
                "user_id" =>$user->id,
            ]);
            return true;
        }
        return false;
    }
}
