<?php
namespace Symfony\Component\HttpKernel\Exception;
class GoneHttpException extends HttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(410, $message, $previous, array(), $code);
    }
}
