<?php
if (!class_exists('TaxJarTest')) {
  require __DIR__ . '/../TaxJarTest.php';
}

class UtilTest extends TaxJarTest {
  public function test_get_api_config() {
    $this->assertEquals($this->client->getApiConfig('base_uri'), 'http://localhost:8082');
  }
  
  public function test_set_api_config() {
    $this->client->setApiConfig('timeout', 100);
    $this->assertEquals($this->client->getApiConfig('timeout'), 100);
  }
}