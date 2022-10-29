<?php

namespace Modules\JwtApi\Services;

class HttpResponseJson implements BaseHttpResponse
{
    /**
     * @param mixed string|array $data
     * @param string|array $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */

    public static function success($data = null, $message = null, $code = 200)
    {
        return response()->json([
            'code'      => $code,
            'success'   => true,
            'message'   => $message,
            'data'      => $data
        ], $code);
    }

    /**
     * @param mixed string|array $errors
     * @param string|array $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($errors = null, $message = null, $code = 400)
    {
        return response()->json([
            'code'      => $code,
            'success'   => false,
            'message'   => $message,
            'errors'    => $errors
        ], $code);
    }
}
