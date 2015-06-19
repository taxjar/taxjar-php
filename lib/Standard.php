<?php
namespace TaxJar;

class Standard extends TaxJar {
  public function withApiKey($key) {
    return new Standard($key);
  }

  public function __construct($key) {
    parent::__construct($key);
  }

  /**
   * Show tax rates for a location
   * http://developers.taxjar.com/api/#show-tax-rates-for-a-location
   *
   * @param int $zip
   * @param array $parameters
   *
   * @return object Detailed rates for a specific location.
   */
  public function getLocationRates($zip, $parameters = array()) {
    $headers = $this->authHeaders();
    $response = $this->request->api('GET', '/v2/standard/rates/' . $zip, $parameters, $headers);

    return $response['body']->rate;
  }

  /**
   * Show sales tax for an order
   * http://developers.taxjar.com/api/#show-sales-tax-for-an-order
   *
   * @param array $parameters
   *
   * @return object Sales tax for an order.
   */
  public function getOrderTaxes($parameters = array()) {
    $headers = $this->authHeaders();
    $response = $this->request->api('POST', '/v2/standard/taxes', $parameters, $headers);

    return $response['body']->tax;
  }
}