<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ExceptionHandler
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (Throwable $e) {

            $message = 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine();

            writeToLog($message);

            return response()->json([
                'error' => [
                    'message' => 'Something went wrong.',
                    'code' => 500,
                ],
            ], 500);
        }
    }
}
