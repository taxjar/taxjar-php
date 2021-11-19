<?php
namespace TaxJar;

class ApiException extends Exception
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * @param string $message
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Throwable|null $previous
     */
    public function __construct($message, $response, $previous = null)
    {
        parent::__construct($message, $response->getStatusCode(), $previous);
        $this->response = $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
