<?php

use App\Enums\HttpCode;
use App\Enums\ResponseMessage as RM;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

if (!function_exists('errorResponse')) {
    function errorResponse(int|array|MessageBag $message, HttpCode $code = HttpCode::BAD_REQUEST): JsonResponse
    {
        if ($message instanceof MessageBag) {
            $message = $message->getMessages();
        }

        return response()->json([
            'status' => false,
            'error' => [
                'code' => $message, // int or array
            ],
        ], $code->toInt());
    }
}

function addPaginatorToResponse(&$data, $paginator): bool
{
    if (!isset($data['totalPage']) && !isset($data['currentPage'])) {
        $data['totalPage'] = $paginator->lastPage();
        $data['currentPage'] = $paginator->currentPage();
        return true;
    }

    return false;
}

if (!function_exists('successResponse')) {
    function successResponse(array $data = [], HttpCode $code = HttpCode::OK): JsonResponse
    {
        # if a element of data is paginator, we need to convert it to array

        foreach ($data as $value) {

            if ($value instanceof LengthAwarePaginator) {
                addPaginatorToResponse($data, $value);
                break;
            }

            if ($value instanceof AnonymousResourceCollection && $value->resource instanceof LengthAwarePaginator) {
                addPaginatorToResponse($data, $value->resource);
                break;
            }
        }

        return response()->json([
            'status' => true,
            'data' => $data,
        ], $code->toInt());
    }
}

if (!function_exists('exceptionResponse')) {
    function exceptionResponse(Exception $exception, HttpCode $code = HttpCode::BAD_REQUEST): JsonResponse
    {
        $message = $exception->getMessage();
        $message .= ' in file : ' . $exception->getFile();
        $message .= ' on line : ' . $exception->getLine();
        return errorResponse($message, $code);
    }
}
