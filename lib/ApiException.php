<?php
namespace TaxJar;

class ApiException extends Exception
{
    protected $response;

    /**
     * @param string $message
     * @param \Psr\Http\Message\ResponseInterface$response
     * @param \Throwable|null $previous
     */
    public function __construct($message, $response, $previous = null)
    {
        parent::__construct($message, $response->getStatusCode(), $previous);
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
