<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use TaxJar\Exception;
use TaxJar\Tests\TaxJarTest;

class ErrorHandlingTest extends TaxJarTest
{
    public function setUp(): void
    {
        // Create the mock handler first
        $this->http = new MockHandler();
        
        // Create a handler stack with the mock handler
        $handler = HandlerStack::create($this->http);
        
        // Add history middleware
        $handler->push(Middleware::history($this->history));
        
        // Create the client (which will set up its own error handling middleware)
        $this->client = new \TaxJar\Client('test');
        
        // Get the client's handler stack (which includes error handling)
        $clientHandler = $this->client->getApiConfig('handler');
        
        // Push our mock handler onto the client's stack
        $clientHandler->setHandler($this->http);
        
        // Set the base URI for testing
        $this->client->setApiConfig('base_uri', 'http://localhost:8082');
    }

    public function testStringErrorDetail()
    {
        try {
            $this->http->append(new Response(400, [], json_encode([
                'status' => '400',
                'error' => 'Bad Request',
                'detail' => 'Invalid request parameters'
            ])));

            $this->client->categories();
            $this->fail('Expected an exception to be thrown');
        } catch (Exception $e) {
            $this->assertEquals('400 Bad Request – Invalid request parameters', $e->getMessage());
            $this->assertEquals(400, $e->getStatusCode());
        }
    }

    public function testArrayErrorDetail()
    {
        try {
            $this->http->append(new Response(406, [], json_encode([
                'status' => '406',
                'error' => 'Not Acceptable',
                'detail' => [
                    'state must be a two-letter ISO code.',
                    'zip must be a valid postal code.'
                ]
            ])));

            $this->client->categories();
            $this->fail('Expected an exception to be thrown');
        } catch (Exception $e) {
            $this->assertEquals('406 Not Acceptable – state must be a two-letter ISO code.; zip must be a valid postal code.', $e->getMessage());
            $this->assertEquals(406, $e->getStatusCode());
        }
    }

    public function testMissingErrorDetail()
    {
        try {
            $this->http->append(new Response(500, [], json_encode([
                'status' => '500',
                'error' => 'Internal Server Error'
            ])));

            $this->client->categories();
            $this->fail('Expected an exception to be thrown');
        } catch (Exception $e) {
            $this->assertEquals('500 Internal Server Error – please try again', $e->getMessage());
            $this->assertEquals(500, $e->getStatusCode());
        }
    }
} 