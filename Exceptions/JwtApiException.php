<?php
namespace Modules\JwtApi\Exceptions;

use Exception;

class JwtApiException extends Exception
{
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
