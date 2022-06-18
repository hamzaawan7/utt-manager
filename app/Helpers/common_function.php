<?php

use Illuminate\Http\JsonResponse;

/**
 * @param $date
 * @return false|string
 */
function dateFormat($date)
{
   return date('Y-m-d H:i:s',strtotime($date));
}

/**
 * @param $message
 * @return JsonResponse
 */
function catchException($message): JsonResponse
{
    return response()->json([
        'status' => '422',
        'message' => $message
    ]);
}
