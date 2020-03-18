<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class ConfigTest extends TaxJarTest
{
    public function testGetApiConfig()
    {
        $this->assertEquals($this->client->getApiConfig('base_uri'), 'http://localhost:8082');
    }

    public function testSetApiConfig()
    {
        $this->client->setApiConfig('timeout', 100);
        $this->assertEquals($this->client->getApiConfig('timeout'), 100);
    }

    public function testGetApiUrl()
    {
        $this->assertEquals($this->client->getApiConfig('api_url'), $this->client->getApiConfig('base_uri'));
    }

    public function testSetApiUrl()
    {
        $this->client->setApiConfig('api_url', 'https://api.sandbox.taxjar.com');
        $this->assertEquals($this->client->getApiConfig('api_url'), $this->client->getApiConfig('base_uri'));
    }

    public function testGetCustomHeaders()
    {
        $headers = $this->client->getApiConfig('headers');

        $this->assertEquals($headers['Authorization'], 'Bearer test');
        $this->assertEquals($headers['Content-Type'], 'application/json');
        $this->assertRegExp('/TaxJar\/PHP \(.*\) taxjar-php\/\d+\.\d+\.\d+/', $headers['User-Agent']);
    }

    public function testSetCustomHeaders()
    {
        $this->client->setApiConfig('headers', [
            'X-TJ-Expected-Response' => 422
        ]);

        $headers = $this->client->getApiConfig('headers');

        $this->assertEquals($headers['Authorization'], 'Bearer test');
        $this->assertEquals($headers['Content-Type'], 'application/json');
        $this->assertEquals($headers['X-TJ-Expected-Response'], 422);
        $this->assertRegExp('/TaxJar\/PHP \(.*\) taxjar-php\/\d+\.\d+\.\d+/', $headers['User-Agent']);
    }
}
