<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\User\SendSmsCodeAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\ConfirmRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
        $this->middleware('auth:sanctum')->only( 'logout');
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = StoreUserAction::run($request->validated());
        SendSmsCodeAction::run($user);
        return $this->successResponse('',
            'code has been successfully sent');
    }

    public function confirm(ConfirmRequest $request, ActivationCodeRepositoryInterface $repository, UserRepositoryInterface $userRepository): JsonResponse
    {

        /** @var User $user */
        $user = $userRepository->find(value: $request->input('mobile'), field: 'mobile', firstOrFail: true);
        $activationCode = $repository->checkCode($user, $request->input('code'));
        if ($activationCode) {
            $repository->useCode($activationCode);
            if (is_null($user->mobile_verify_at)) {
                $userRepository->verifyUser($user);
            }
            $data = $request->validated();
            $data['password'] = Hash::make($request->input('password'));
            $user = UpdateUserAction::run($user, $data);
            $token = $userRepository->generateToken($user);
        } else {
            return $this->errorResponse('Code not found or expired');
        }

        return $this->successResponse([
            'token' => $token,
            'user' => UserResource::make($user)
        ], 'User authenticated successfully');

    }

    public function login(LoginRequest $request, UserRepositoryInterface $userRepository): JsonResponse
    {
        $credentials = $request->only('mobile', 'password');
        $user = $userRepository->find(value: $request->input('mobile'), field: 'mobile', firstOrFail: true);
        if (auth()->attempt($credentials)) {
            $token = $userRepository->generateToken($user);
            return $this->successResponse([
                'token' => $token,
                'user' => UserResource::make($user)
            ], 'User authenticated successfully');
        }
        return $this->errorResponse('Unauthorized', 401);
    }

    public function forgetPassword(ForgetPasswordRequest $request, UserRepositoryInterface $repository): ?JsonResponse
    {
        /** @var User $user */
        $user = $repository->find(value: $request->input('mobile'), field: 'mobile', firstOrFail: true);
        SendSmsCodeAction::run($user);
        return $this->successResponse('', 'verification code has been successfully sent');
    }

    public function logout(): JsonResponse
    {
        if (auth()->check()) {
            Auth::user()?->tokens()->delete();
            return $this->successResponse('', 'You have successfully logged out');
        }
        return $this->errorResponse(' No authenticated user detected.', 401);
    }
}
