<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ResetPasswordTokenInvalidException extends Exception
{
    protected $message = 'Reset password token not valid.';

    public function render(): JsonResponse
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 400);
    }
}
