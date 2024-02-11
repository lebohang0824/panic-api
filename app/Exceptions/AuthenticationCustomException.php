<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticationCustomException extends AuthenticationException
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => 'Authentication error',
            'data' => []
        ], Response::HTTP_UNAUTHORIZED);
    }
}
