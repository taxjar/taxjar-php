<?php
namespace TaxJar;

class Client extends TaxJar {
  public function withApiKey($key) {
    return new Client($key);
  }

  public function __construct($key) {
    parent::__construct($key);
  }

  /**
   * Get tax categories
   * http://developers.taxjar.com/api/#categories
   *
   * @return object Collection of tax categories.
   */
  public function categories() {
    $headers = $this->authHeaders();
    $response = $this->request->api('GET', '/v2/categories', null, $headers);

    return $response['body'];
  }

  /**
   * Get tax rates for a location
   * http://developers.taxjar.com/api/#show-tax-rates-for-a-location11
   *
   * @param int $zip
   * @param array $parameters
   *
   * @return object Detailed rates for a specific location.
   */
  public function ratesForLocation($zip, $parameters = array()) {
    $headers = $this->authHeaders();
    $response = $this->request->api('GET', '/v2/rates/' . $zip, $parameters, $headers);

    return $response['body']->rate;
  }

  /**
   * Get sales tax for an order
   * http://developers.taxjar.com/api/#taxes12
   *
   * @param array $parameters
   *
   * @return object Detailed sales tax breakdown for an order.
   */
  public function taxForOrder($parameters = array()) {
    $headers = $this->authHeaders();
    $response = $this->request->api('POST', '/v2/taxes', $parameters, $headers);

    return $response['body']->tax;
  }

  /**
   * Create a new order transaction
   * http://developers.taxjar.com/api/#create-an-order-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function createOrder($parameters = array()) {
    $headers = $this->authHeaders();
    $response = $this->request->api('POST', '/v2/transactions/orders', $parameters, $headers);

    return $response['body'];
  }

  /**
   * Update an existing order transaction
   * http://developers.taxjar.com/api/#update-an-order-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function updateOrder($transaction_id, $parameters = array()) {
    $headers = $this->authHeaders();
    $response = $this->request->api('PUT', '/v2/transactions/orders/' . $transaction_id, $parameters, $headers);

    return $response['body'];
  }

  /**
   * Create a new refund transaction
   * http://developers.taxjar.com/api/#create-an-refund-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function createRefund($parameters = array()) {
    $headers = $this->authHeaders();
    $response = $this->request->api('POST', '/v2/transactions/refunds', $parameters, $headers);

    return $response['body'];
  }

  /**
   * Update an order transaction
   * http://developers.taxjar.com/api/#update-an-refund-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function updateRefund($transaction_id, $parameters = array()) {
    $headers = $this->authHeaders();
    $response = $this->request->api('PUT', '/v2/transactions/refunds/' . $transaction_id, $parameters, $headers);

    return $response['body'];
  }
}