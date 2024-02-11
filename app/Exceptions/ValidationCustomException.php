<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ValidationCustomException extends ValidationException
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => 'Validation error',
            'data' => $this->validator->errors()->getMessages()
        ], Response::HTTP_BAD_REQUEST);
    }
}
