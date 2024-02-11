<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the  session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->renderable(function (ValidationException $exception) {
            throw ValidationCustomException::withMessages($exception->validator->getMessageBag()->getMessages());
        });

        $this->renderable(function (AccessDeniedHttpException $exception) {
            throw new AccessDeniedHttpCustomException;
        });

        $this->renderable(function (AuthenticationException $exception) {
            throw new AuthenticationCustomException;
        });

        $this->reportable(function (Throwable $e) {
        });
    }
}
