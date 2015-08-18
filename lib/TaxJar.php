<?php
namespace TaxJar;

class TaxJar {
  protected $api_key;
  protected $request;

  public function __construct($key) {
    $this->request = new Util\Request();
    $this->setApiKey($key);
  }

  protected function headers() {
    $headers = array();
    
    $headers['Content-Type'] = 'application/json';

    if ($this->api_key) {
      $headers['Authorization'] = 'Bearer ' . $this->api_key;
    }

    return $headers;
  }

  public function getApiKey() {
    return $this->api_key;
  }

  public function setApiKey($api_key) {
    $this->api_key = $api_key;
  }
}