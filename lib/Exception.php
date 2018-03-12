<?php
namespace TaxJar;

class Exception extends \Exception
{
    protected $status_code;

    public function __construct($message, $status_code = 0)
    {
        $this->status_code = $status_code;
        parent::__construct($message);
    }

    final public function getStatusCode()
    {
        return $this->status_code;
    }
}
