<?php

namespace Modules\JwtApi\Services;

interface BaseHttpResponse
{
    public static function success($data = null, $message = null, $code = 200);
    public static function error($errors = null, $message = null, $code = 400);
}
