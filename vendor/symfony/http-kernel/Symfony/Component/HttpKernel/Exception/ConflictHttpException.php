<?php
namespace Symfony\Component\HttpKernel\Exception;
class ConflictHttpException extends HttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(409, $message, $previous, array(), $code);
    }
}
