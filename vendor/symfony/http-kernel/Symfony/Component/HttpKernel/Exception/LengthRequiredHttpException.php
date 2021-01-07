<?php
namespace Symfony\Component\HttpKernel\Exception;
class LengthRequiredHttpException extends HttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(411, $message, $previous, array(), $code);
    }
}
