<?php 

namespace App\Exceptions;

class SampleIgnoreException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}