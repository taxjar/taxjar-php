<?php
namespace TaxJar\Util;

class Request {
  protected $api_base = 'https://api.taxjar.com';

  public function api($method, $uri, $parameters = array(), $headers = array()) {
    return $this->send($method, $this->api_base . $uri, $parameters, $headers);
  }

  public function send($method, $url, $parameters = array(), $headers = array()) {
    if (is_array($parameters) || is_object($parameters)) {
      $parameters = http_build_query($parameters);
    }

    $httpHeaders = array();
    foreach ($headers as $key => $val) {
      $httpHeaders[] = "$key: $val";
    }

    $options = array(
      CURLOPT_HEADER => true,
      CURLOPT_HTTPHEADER => $httpHeaders,
      CURLOPT_RETURNTRANSFER => true
    );

    $url = rtrim($url, '/');
    $method = strtoupper($method);

    switch ($method) {
      case 'POST':
        $options[CURLOPT_POST] = true;
        $options[CURLOPT_POSTFIELDS] = $parameters;
        break;
      default:
        $options[CURLOPT_CUSTOMREQUEST] = $method;
        if ($parameters) {
          $url .= '/?' . $parameters;
        }
        break;
    }

    $options[CURLOPT_URL] = $url;

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    list($headers, $body) = explode("\r\n\r\n", $response, 2);
    $body = json_decode($body);

    if ($status < 200 || $status > 299) {
      if (isset($body->error)) {
        throw new Exception($body->error . ': ' . $body->detail, $status);
      } else {
        throw new Exception("No 'error' provided in response body.", $status);
      }
    }

    return array(
      'body' => $body,
      'headers' => $headers,
      'status' => $status
    );
  }
}