<?php

namespace App\Http;


class ApiHelper
{

    /**
     * @param $data
     * @param string $message
     * @param string $status
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    static public function toJson($data, $message = '', $status = 'success', $code = 200)
    {
        return response()->json([
            'status' => $status,
            'status_code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * @param string $message
     * @param string $status
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    static public function toError($message = '', $status = 'error', $code = 400)
    {
        return response()->json([
            'status' => $status,
            'status_code' => $code,
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @param string $status
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    static public function toSuccess($message = '', $status = 'success', $code = 200)
    {
        return response()->json([
          'status' => $status,
          'status_code' => $code,
          'message' => $message
        ]);
    }
}