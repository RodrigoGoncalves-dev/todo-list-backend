<?php

namespace App\Services;

use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
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

        return User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $userPassword,
            'confirmation_token' => Str::random(60)
        ]);
    }
}
