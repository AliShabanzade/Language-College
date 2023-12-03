<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\User\SendSmsCodeAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\ConfirmRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout', 'setPassword');
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = StoreUserAction::run($request->validated());
        SendSmsCodeAction::run($user);
        return $this->successResponse($user);
    }

    public function confirm(ConfirmRequest $request, ActivationCodeRepositoryInterface $repository, UserRepositoryInterface $userRepository): JsonResponse
    {
        $user = $userRepository->find($request->input('mobile'), 'mobile', firstOrFail: true);
        $activationCode = $repository->checkCode($user, $request->input('code'));

        if (!$activationCode) {
            return $this->errorResponse(trans('authentication.please_enter_validation_code'));
        }
        $repository->useCode($activationCode);
        if (is_null($user->mobile_verify_at)) {
            $userRepository->verifyUser($user);
        }

        $token = $userRepository->generateToken($user);
        return $this->successResponse([
            'token' => $token,
            'user'  => UserResource::make($user),
        ]);
    }

    public function setPassword(SetPasswordRequest $request, UserRepositoryInterface $repository): JsonResponse
    {

        $user = auth()->user();
        if (!$user) {
            return $this->errorResponse(trans('authentication.Failed_to_update_user'));
        }
        $data = $request->validated();
        $data['password'] = Hash::make($request->input('password'));
        $user = UpdateUserAction::run($user, $data);

        return $this->successResponse([
            'user' => UserResource::make($user)
        ], trans('authentication.Password_registered_successfully'));
    }


    public function login(LoginRequest $request, UserRepositoryInterface $userRepository): JsonResponse
    {

        $credentials = $request->only('mobile', 'password');
        $user = $userRepository->find(value: $request->input('mobile'), field: 'mobile', firstOrFail: true);
        if (!empty($user->password) && Auth::guard('web')->attempt($credentials)) {
            $token = $userRepository->generateToken($user);
            return $this->successResponse([
                'token' => $token,
                'user'  => UserResource::make($user)
            ], trans('authentication.user_authenticated_successfully'));
        }
        return $this->errorResponse(trans('authentication.mobile_or_password_not_match'), 404);
    }

    public function forgetPassword(ForgetPasswordRequest $request, UserRepositoryInterface $repository): ?JsonResponse
    {
        /** @var User $user */
        $user = $repository->find(value: $request->input('mobile'), field: 'mobile', firstOrFail: true);
        SendSmsCodeAction::run($user);
        return $this->successResponse('', trans('authentication.verification_code_has_been_successfully_sent'));
    }

    public function logout(): JsonResponse
    {
        if (auth()->check()) {
            Auth::user()?->tokens()->delete();
            return $this->successResponse('', trans('authentication.You_have_successfully_logged_out'));
        }
        return $this->errorResponse(trans('authentication.No_authenticated_user_detected'), 401);
    }
}
