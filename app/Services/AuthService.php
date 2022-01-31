<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\User;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * @throws LoginInvalidException
     */
    public function login(string $email, string $password): array
    {
        $login = [
            'email' => $email,
            'password' => $password,
        ];

        $token = auth()->attempt($login);

        if(!$token) {
            throw new LoginInvalidException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];
    }

    /**
     * @throws UserHasBeenTakenException
     */
    public function register(string $first_name, string $last_name, string $email, string $password)
    {
        $user = User::where('email', $email)->exists();

        if(!empty($user)) throw new UserHasBeenTakenException();

        $userPassword = bcrypt($password ?? Str::random(10));

        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $userPassword,
            'confirmation_token' => Str::random(30)
        ]);

        event(new UserRegistered($user));

        return $user;
    }

    /**
     * @throws VerifyEmailTokenInvalidException
     */
    public function verifyEmail(string $token)
    {
        $user = User::where('confirmation_token', $token)->first();
        if(empty($user)) {
            throw new VerifyEmailTokenInvalidException();
        }

        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }
}
