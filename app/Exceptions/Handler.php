<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($this->isApiRequest($request)) {
            if ($e instanceof ValidationException) {
                return $this->apiError(
                    'Validation failed',
                    $e->errors(),
                    422
                );
            }

            if ($e instanceof NotFoundHttpException) {
                return $this->apiError('Resource not found', null, 404);
            }

            if ($e instanceof AuthenticationException) {
                return $this->apiError('Unauthenticated', null, 401);
            }

            if ($e instanceof HttpExceptionInterface) {
                return $this->apiError(
                    $e->getMessage() !== '' ? $e->getMessage() : 'HTTP error',
                    null,
                    $e->getStatusCode()
                );
            }

            if (config('app.debug')) {
                return $this->apiError($e->getMessage(), [
                    'exception' => class_basename($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ], 500);
            }

            return $this->apiError('Internal server error', null, 500);
        }

        return parent::render($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($this->isApiRequest($request) || $request->expectsJson()) {
            return $this->apiError('Unauthenticated', null, 401);
        }

        return redirect()->guest(route('login'));
    }

    private function isApiRequest(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }

    private function apiError(string $message, mixed $errors, int $status): JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
            'message' => $message,
        ], $status);
    }
}
