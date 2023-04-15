<?php

namespace App\Traits;

trait ApiResponse
{
    public function successResponse($data, $statusCode = 200)
    {
        return response(\GuzzleHttp\json_decode($data), $statusCode);
    }
    public function errorResponse($errorMessage, $statusCode)
    {
        return response()->json(['error' => $errorMessage, 'error_code' => $statusCode], $statusCode);
    }
    public function errorMessage($errorMessage, $statusCode)
    {
        return response($errorMessage, $statusCode)->header('Content-Type', 'application/json');
    }
}
