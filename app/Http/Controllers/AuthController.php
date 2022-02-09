<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Http\Requests\AuthForgotPasswordResquest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthVerifyEmailRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @throws LoginInvalidException
     */
    public function login(AuthLoginRequest $request): UserResource
    {
        $input = $request->validated();
        $token = $this->authService->login($input['email'], $input['password']);

        return (new UserResource(auth()->user()))->additional($token);
    }

    /**
     * @throws UserHasBeenTakenException
     */
    public function register(AuthRegisterRequest $authRegisterRequest): UserResource
    {
        $input = $authRegisterRequest->validated();
        $user = $this->authService->register($input['first_name'], $input['last_name'] ?? '', $input['email'], $input['password']);

        return new UserResource($user);
    }

    public function verifyEmail(AuthVerifyEmailRequest $authVerifyEmailRequest): UserResource
    {
        $input = $authVerifyEmailRequest->validated();
        $user = $this->authService->verifyEmail($input['token']);

        return new UserResource($user);
    }

    public function forgotPassword(AuthForgotPasswordResquest $request)
    {
        $input = $request->validated();
        return $this->authService->forgotPassword($input['email']);
    }
}
