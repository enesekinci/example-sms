<?php

use Illuminate\Support\Facades\Log;

if (!function_exists('writeToLog')) {
    function writeToLog(mixed $message): void
    {
        $content = '';

        if ($message instanceof Throwable) {
            $content = json_encode([
                'message' => $message->getMessage(),
                'line' => $message->getLine(),
                'file' => $message->getFile(),
            ]);
        } else if (is_string($message) || is_numeric($message) || is_bool($message)) {
            $content = $message;
        } else if (is_array($message) || is_object($message)) {
            $content = json_encode($message);
        }

        Log::channel('data')->error($content);
    }
}
