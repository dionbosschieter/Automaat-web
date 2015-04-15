<?php namespace App\Exceptions;

class ApiException extends \RuntimeException
{

    /**
     * Transform the message and code into a string
     *
     * @return string
     */
    public function __toString()
    {
        $errorCode = sprintf("%02d",$this->code);

        return "Ex{$errorCode}:{$this->message}";
    }


}