<?php
if (!class_exists('TaxJarTest')) {
  require __DIR__ . '/../TaxJarTest.php';
}

class TokenTest extends TaxJarTest {
  public function test_token_exception() {
    try {
      $this->client = TaxJar\Client::withApiKey(null);
    } catch(Exception $e) {
      $this->assertEquals($e->getMessage(), 'Please provide an API key.');
    }
  }
}