<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\User\SendSmsCodeAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\VerifyCodeAction;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Api\V1\JsonResponse;
use App\Models\SmsToken;
use App\Services\Sms\Sms;
use App\Services\User\StoreUserService;
use Illuminate\Http\Request;
use App\Http\Requests\loginWithCodeRequest;
use App\Http\Requests\sendSmsCodeRequest;
use App\Models\SmsConfig;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('setPassword');
    }

    public function registerPhone(RegisterRequest $request)
    {

        $user=StoreUserAction::run($request->validated());

     ///کد برای کاربر ارسال میشود
     $saveCode=SendSmsCodeAction::run($user['mobile_number']);

        if ($saveCode) {
            return $this->successResponse('', 'code has been successfully sent');
        } else {
            return $this->successResponse('', 'please try again', 404);
        }
    }

    public function setCode(Request $request)
    {
        $otpUser = SmsToken::where('secret_code', $request['secret_code'])
            ->where('code', $request['code'])
            ->where('user_id', $request['user_id'])
            ->first();


        if ($otpUser) {
            if ($otpUser->isValid()) {

                VerifyCodeAction::run($otpUser);
                $token = $otpUser->user->createToken('token')->plainTextToken;
            }else{
                return $this->errorResponse('The code is either expired or used.', 422);
            }
        }else{
            return $this->errorResponse( 'Code not found', 404);
        }

        return $this->successResponse($token, 'User authenticated successfully');

    }
//_________________________Set Password________________________________

    public function setPassword(User $user,AuthRequest $request)
    {

        $user = auth()->user();

        $data=$request->validated();

        $data['password']=Hash::make('password');

         $setpassword=UpdateUserAction::run($user,$data);

        if ($user->save()) {

            return $this->successResponse( $setpassword, 'successfuly');

        } else {

            return $this->errorResponse( 'please try again');
        }
    }

    //---------------------------- login -----------------------------

    public function login(LoginRequest $request): JsonResponse
    {

        $user = User::where('mobile_number', $request->mobile_number)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('', 'Login invalid');
        }
        if (!$user) {
            return $this->errorResponse([
                'Unauthorized'], '401');
        }
        return $this->successResponse($user->createToken(
            'Personal Access Token')->plainTextToken,
            'User Login Successfully');
    }
//________________________ForgetPassword______________________
    public function forgetPassword(loginWithCodeRequest $request)
    {

        $user = User::where('mobile_number', $request->mobile_number)->first();
        if(!$user){
            return $this->errorResponse('کاربر یافت نشد وارد صفحه ثبت نام شوید');
        }

        ///کدبرای کاربر ارسال میشود
        $saveCode=SendSmsCodeAction::run( $request->mobile_number);

        if ($saveCode) {
            return $this->successResponse('', 'verification code has been successfully sent');
        } else {
            return $this->successResponse('', 'please try again', 404);
        }


//        $user->access_token = $user->createAccessToken();
//        return $this->successResponse(  $user->access_token , message: 'User Login Successfully');
    }

    public function logout(Request $request)
    {

        $user = Auth::user()->tokens()->delete();
        return $this->successResponse($user, 'user logged out');

    }
}
