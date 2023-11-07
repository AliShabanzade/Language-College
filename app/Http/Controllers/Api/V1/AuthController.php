<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\User\SendSmsCodeAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\UpdateCodeAction;
use App\Enums\PermissionEnum;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AuthController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('setPassword', 'logout');
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
//--------------------------confirm password----------------
    public function confirm(
        Request                           $request,
        ActivationCodeRepositoryInterface $repository,
        UserRepositoryInterface           $userRepository,
    )
    {
        /** @var User $user */
        $user = $userRepository->findByMobile($request->input('mobile_number'));
//        dd($user);
        if (!$user) {
            return $this->errorResponse('User Not Found');
        }
        $otpUser = $repository->otpUser($request['code'], $user);

        if ($otpUser) {
            UpdateCodeAction::run($otpUser);
            if (is_null($user->mobile_verify_at)) {
                $userRepository->verifyUser($user);
            }
            $token = $otpUser->user->createToken('token')->plainTextToken;
        } else {
            return $this->errorResponse('Code not found or expired');
        }

        return $this->successResponse([
            'token' => $token,
            'user'  => UserResource::make($user)
        ], 'User authenticated successfully');

    }

//_________________________Set Password________________________________

    public function setPassword(AuthRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $data['password'] = Hash::make($request->input('password'));
        $user = UpdateUserAction::run($user, $data);
        return $this->successResponse($user, trans('authentication.password_save_successfully'));
    }

    //---------------------------- login -----------------------------


    public function login(LoginRequest $request, UserRepositoryInterface $userRepository)
    {
        $credentials = $request->only('mobile_number', 'password');
        $user = $userRepository->findByMobile($credentials['mobile_number']);
        if (!$user) {
            return $this->errorResponse('please go to register page');
        }

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('token')->plainTextToken;
            return $this->successResponse($token, 'user  authorized');
        }
        return $this->errorResponse('');
    }

//________________________ForgetPassword______________________
    public function forgetPassword(
        Request                 $request,
        UserRepositoryInterface $repository,
    )
    {

        /** @var User $user */
        $user = $repository->findByMobile($request->mobile_number);
        if (!$user) {
            return $this->errorResponse('کاربر یافت نشد وارد صفحه ثبت نام شوید');
        }

        // sending otp cod to current user
        $saveCode = SendSmsCodeAction::run($request->mobile_number);
        if ($saveCode) {
            return $this->successResponse('', 'verification code has been successfully sent');
        } else {
            return $this->errorResponse('please try again', 404);
        }
    }


    public function logout()
    {
        if (auth()->check()) {
            Auth::user()->tokens()->delete();
            return $this->successResponse('', 'You have successfully logged out', 200);
        }
        return $this->errorResponse(' No authenticated user detected.', 401);
    }
}
