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

    public function render($request, Throwable $e): Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof ModelNotFoundException) {
            return errorResponse(RM::NOT_FOUND, HttpCode::NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {
            return errorResponse(RM::NOT_FOUND, HttpCode::NOT_FOUND);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return errorResponse(RM::METHOD_NOT_ALLOWED, HttpCode::METHOD_NOT_ALLOWED);
        }

        return parent::render($request, $e);
    }
}
