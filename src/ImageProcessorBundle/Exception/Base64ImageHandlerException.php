<?php
namespace ImageProcessorBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Triggered when Image entity related errors occur.
 */
class Base64ImageHandlerException extends HttpException
{

    public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = array(), $code = 0)
    {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
        dump($this->getMessage()); exit;
    }

    public function getErrorDetails()
    {
        return [
            'code' => $this->getstatusCode() ?: 999,
            'message' => $this->getMessage()?:'API Exception',
        ];
    }
}