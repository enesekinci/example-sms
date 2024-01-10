<?php

namespace App\Exceptions;

use App\Enums\HttpCode;
use App\Enums\ResponseMessage as RM;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use function errorResponse;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception): Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($exception instanceof ModelNotFoundException) {
            return errorResponse(RM::NOT_FOUND, HttpCode::NOT_FOUND);
        }

        if ($exception instanceof NotFoundHttpException) {
            return errorResponse(RM::NOT_FOUND, HttpCode::NOT_FOUND);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return errorResponse(RM::METHOD_NOT_ALLOWED, HttpCode::METHOD_NOT_ALLOWED);
        }

        return parent::render($request, $exception);
    }
}
