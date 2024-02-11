<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AccessDeniedHttpCustomException extends AccessDeniedHttpException
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => 'Authorization error',
            'data' => []
        ], Response::HTTP_UNAUTHORIZED);
    }
}
