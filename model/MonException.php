<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 13/12/2017
 * Time: 11:12
 */

class MonException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function __toString()
    {
        return $this->message;
    }
}