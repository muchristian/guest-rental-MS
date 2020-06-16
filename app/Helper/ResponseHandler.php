<?php

namespace App\Helper;

class ResponseHandler {
    public static function successResponse($message, $statusCode, $data, $token) {
        return response()->json([
            'message' => $message,
            'status' => 'success',
            'data' => $data,
            'token' => $token
        ], $statusCode);
        }
    
    public static function errorResponse($message, $statusCode) {
        return response()->json([
            'error' => $message,
            'status' => 'failed'
        ], $statusCode);
                    }
}

