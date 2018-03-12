<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class UtilTest extends TaxJarTest
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
}
