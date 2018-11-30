<?php
namespace TaxJar;

class Exception extends \Exception
{
    /**
     * Alias to getCode, for backwards compatibility
     */
    final public function getStatusCode()
    {
        return $this->getCode();
    }
}
