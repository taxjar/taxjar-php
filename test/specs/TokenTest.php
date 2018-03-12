<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class TokenTest extends TaxJarTest
{
    public function testTokenException()
    {
        try {
            $this->client = TaxJar\Client::withApiKey(null);
        } catch (Exception $e) {
            $this->assertEquals($e->getMessage(), 'Please provide an API key.');
            $this->assertEquals($e->getStatusCode(), 0);
        }
    }

    public function testUnauthorizedTokenException()
    {
        try {
            $this->http->mock
                ->when()
                ->methodIs('GET')
                ->pathIs('/categories')
                ->then()
                ->statusCode(401)
                ->body(json_encode([
                    'error' => "Unauthorized",
                    'detail' => "Not authorized for route 'GET /v2/categories'",
                    'status' => 401,
                ]))
                ->end();

            $this->http->setUp();

            $response = $this->client->categories();
        } catch (Exception $e) {
            $this->assertEquals($e->getMessage(), "401 Unauthorized – Not authorized for route 'GET /v2/categories'");
            $this->assertEquals($e->getStatusCode(), 401);
        }
    }

    public function testExpiredTokenException()
    {
        try {
            $this->http->mock
                ->when()
                ->methodIs('GET')
                ->pathIs('/categories')
                ->then()
                ->statusCode(403)
                ->body(json_encode([
                    'error' => "Forbidden",
                    'detail' => "Not authorized for resource",
                    'status' => 403,
                ]))
                ->end();

            $this->http->setUp();

            $response = $this->client->categories();
        } catch (Exception $e) {
            $this->assertEquals($e->getMessage(), "403 Forbidden – Not authorized for resource");
            $this->assertEquals($e->getStatusCode(), 403);
        }
    }
}
