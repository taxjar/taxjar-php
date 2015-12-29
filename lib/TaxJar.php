<?php
namespace TaxJar;

class TaxJar {
  protected $client;
  protected $config;

  public function __construct($key) {
    if ($key) {
      $this->config = [
        'base_uri' => 'https://api.taxjar.com/v2/',
        'handler' => $this->errorHandler(),
        'headers' => [
          'Authorization' => 'Bearer ' . $key
        ]
      ];
      $this->client = new \GuzzleHttp\Client($this->config);
    } else {
      throw new Exception('Please provide an API key.');
    }
  }
  
  private function errorHandler() {
    $handler = \GuzzleHttp\HandlerStack::create();
    $handler->push(\GuzzleHttp\Middleware::mapResponse(function($response) {
      if ($response->getStatusCode() >= 400) {
        $data = json_decode($response->getBody());
        throw new Exception(sprintf('%s %s – %s', $response->getStatusCode(), $data->error, $data->detail));
      }
      
      return $response;
    }));
    
    return $handler;
  }
  
  private function refreshClient($config) {
    $this->client = new \GuzzleHttp\Client($config);
  }

  public function setApiConfig($index, $value) {
    $this->config[$index] = $value;
    $this->refreshClient($this->config);
  }
  
  public function getApiConfig($index) {
    if ($index) {
      return $this->config[$index];
    } else {
      return $this->config;
    }
  }
}