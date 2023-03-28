<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Mockery\Exception\InvalidOrderException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
    public function register() : void
    {
        $this->reportable(function (Throwable $e) {
            return $this->sendErrorResponse($e->getMessage(), [], $e->getCode() != 0 ? $e->getCode() : 500);
        });

        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendErrorResponse('Record not found.', [], 404);
            }
        });

        $this->renderable(function (Exception $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendErrorResponse($e->getMessage(), [], 500);
            }

            return response()->view('errors.invalid-order', [], 500);
        });
    }

    public function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return $this->sendErrorResponse('You are not authenticated. Please log in.', [], 401);
        }

        return redirect()->guest('login');
    }
}