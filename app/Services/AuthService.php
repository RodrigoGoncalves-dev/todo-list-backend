<?php

namespace App\Services;

use App\Exceptions\LoginInvalidException;

class AuthService
{
    /**
     * @throws LoginInvalidException
     */
    public function login(string $email, string $password)
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
}
