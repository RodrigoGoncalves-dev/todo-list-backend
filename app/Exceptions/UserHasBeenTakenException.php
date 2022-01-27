<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserHasBeenTakenException extends Exception
{
    protected $message = 'User has been taken.';

    public function render(): JsonResponse
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 400);
    }
}
