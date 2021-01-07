<?php
namespace Symfony\Component\HttpKernel\Exception;
class NotAcceptableHttpException extends HttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(406, $message, $previous, array(), $code);
    }
}
