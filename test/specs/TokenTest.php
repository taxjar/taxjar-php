<?php

namespace TaxJar\Tests\specs;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use TaxJar\Client;
use TaxJar\Tests\TaxJarTest;

class TokenTest extends TaxJarTest
{
    public function testTokenException()
    {
        try {
            $this->client = Client::withApiKey(null);
        } catch (Exception $e) {
            $this->assertEquals($e->getMessage(), 'Please provide an API key.');
            $this->assertEquals($e->getStatusCode(), 0);
        }
    }

    public function testUnauthorizedTokenException()
    {
        try {
            $this->http->append(new Response(401, [], json_encode([
                'error' => "Unauthorized",
                'detail' => "Not authorized for route 'GET /v2/categories'",
                'status' => 401,
            ])));

            $response = $this->client->categories();
        } catch (ClientException $e) {
            $this->assertStringContainsString('Client error: `GET http://localhost:8082/categories` resulted in a `401 Unauthorized` response:', $e->getMessage());
            $this->assertEquals($e->getCode(), 401);
        }
    }

    public function testExpiredTokenException()
    {
        try {
            $this->http->append(new Response(403, [], json_encode([
                'error' => "Forbidden",
                'detail' => "Not authorized for resource",
                'status' => 403,
            ])));

            $response = $this->client->categories();
        } catch (ClientException $e) {
            $this->assertStringContainsString('Client error: `GET http://localhost:8082/categories` resulted in a `403 Forbidden` response', $e->getMessage());
            $this->assertEquals($e->getCode(), 403);
        }
    }
}
