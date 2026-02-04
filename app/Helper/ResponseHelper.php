<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function jsonResponse($success, $message, $data, $statuscode): JsonResponse
    {
        return response()->json([
            'status' => $success,
            'message' => $message,
            'data' => $data,
        ], $statuscode);
    }


}
