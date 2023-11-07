<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\User\SendSmsCodeAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\UpdateCodeAction;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('setPassword' , 'logout');
    }

    public function register(RegisterRequest $request)
    {
        $user = StoreUserAction::run($request->validated());

        ///کد برای کاربر ارسال میشود
        $saveCode = SendSmsCodeAction::run($user['mobile_number']);

        if ($saveCode) {
            return $this->successResponse(RegisterResource::make($user),
                'code has been successfully sent');
        }
        return $this->errorResponse('please try again');
    }

    public function setCode(
        Request $request,
        ActivationCodeRepositoryInterface $repository,
        UserRepositoryInterface $userRepository,
    )

    {
        $user = $userRepository->findByMobile($request->mobile_number)->first();
        if (!$user) {
            return $this->errorResponse('User Not Found');
        }
        $otpUser = $repository->otpUser($request['code'], $user)->first();


        if ($otpUser) {
            if ( $otpUser->notUsed()) {

                UpdateCodeAction::run($otpUser);
                $token = $otpUser->user->createToken('token')->plainTextToken;
            } else {
                return $this->errorResponse('The code is either expired or used.', 422);
            }
        } else {
            return $this->errorResponse('Code not found or expired');
        }

        return $this->successResponse($token, 'User authenticated successfully');

    }

//_________________________Set Password________________________________

    public function setPassword(AuthRequest $request)
    {

        $user = auth()->user();

        $data = $request->validated();

        $data['password'] = Hash::make($request->password);

        $setPassword = UpdateUserAction::run($user, $data);

        if ($user->save()) {

            return $this->successResponse($setPassword, 'password has been successfully saved');

        } else {

            return $this->errorResponse('please try again');
        }
    }

    //---------------------------- login -----------------------------


    public function login(LoginRequest $request)
    {

        $credentials = $request->only('mobile_number', 'password');
        $user=User::where(['mobile_number'=>$credentials['mobile_number']])->first();

        if (auth()->attempt($credentials)){
            $user=auth()->user();

            $token= $user->createToken('token')->plainTextToken;
            return $this->successResponse($token , 'user  authorized');

        }




        return $this->successResponse('' , 'User was not Unauthorized' , 401);


    }

//________________________ForgetPassword______________________
    public function forgetPassword(
        Request                 $request,
        UserRepositoryInterface $repository,
    )
    {

        $user = $repository->findByMobile($request->mobile_number)->first();
        if (!$user) {
            return $this->errorResponse('کاربر یافت نشد وارد صفحه ثبت نام شوید');
        }

        // sending otp cod to current user
        $saveCode = SendSmsCodeAction::run($request->mobile_number);

        if ($saveCode) {
            return $this->successResponse('', 'verification code has been successfully sent');
        } else {
            return $this->successResponse('', 'please try again', 404);
        }


//
    }


    public function logout()
    {
        if (auth()->check()) {

            Auth::user()->tokens->each(function ($token, $key) {
                $token->delete();
            });

            return $this->successResponse('', 'You have successfully logged out', 200);
        }


        return $this->errorResponse(' No authenticated user detected.', 401);
    }
}
