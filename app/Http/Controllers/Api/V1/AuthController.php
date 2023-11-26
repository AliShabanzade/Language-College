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
            return $this->errorResponse("please enter validation code");
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
            return $this->errorResponse('Failed to update user');
        }
        $data = $request->validated();
        $data['password'] = Hash::make($request->input('password'));
        $user = UpdateUserAction::run($user, $data);

        return $this->successResponse([
            'user'  => UserResource::make($user)
        ], 'User authenticated successfully');
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
            ], 'User authenticated successfully');
        }
        return $this->errorResponse('mobile and password not match', 404);
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
