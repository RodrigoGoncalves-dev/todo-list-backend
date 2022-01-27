<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class LoginInvalidException extends Exception
{
    protected $message = 'Email and password don\'t match.';

    public function render(): JsonResponse
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 401);
    }
}
