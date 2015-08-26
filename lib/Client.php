<?php
namespace TaxJar;

class Client extends TaxJar {
  public static function withApiKey($key) {
    return new Client($key);
  }

  public function __construct($key) {
    parent::__construct($key);
  }

  /**
   * Get tax categories
   * http://developers.taxjar.com/api/?php#list-tax-categories
   *
   * @return object Collection of tax categories.
   */
  public function categories() {
    $headers = $this->headers();
    $response = $this->request->api('GET', '/v2/categories', null, $headers);

    return $response['body'];
  }

  /**
   * Get tax rates for a location
   * http://developers.taxjar.com/api/?php#show-tax-rates-for-a-location
   *
   * @param int $zip
   * @param array $parameters
   *
   * @return object Detailed rates for a specific location.
   */
  public function ratesForLocation($zip, $parameters = array()) {
    $headers = $this->headers();
    $response = $this->request->api('GET', '/v2/rates/' . $zip, $parameters, $headers);

    return $response['body']->rate;
  }

  /**
   * Get sales tax for an order
   * http://developers.taxjar.com/api/?php#calculate-sales-tax-for-an-order
   *
   * @param array $parameters
   *
   * @return object Detailed sales tax breakdown for an order.
   */
  public function taxForOrder($parameters = array()) {
    $headers = $this->headers();
    $response = $this->request->api('POST', '/v2/taxes', $parameters, $headers);

    return $response['body']->tax;
  }

  /**
   * List order transactions
   * http://developers.taxjar.com/api/?php#list-order-transactions
   *
   * @param array $parameters
   *
   * @return object Order collection.
   */
  public function listOrders($parameters = array()) {
    $headers = $this->headers();
    $response = $this->request->api('GET', '/v2/transactions/orders', $parameters, $headers);

    return $response['body'];
  }

  /**
   * Show order transaction
   * http://developers.taxjar.com/api/?php#show-an-order-transaction
   *
   * @param integer $transaction_id
   *
   * @return object Order object.
   */
  public function showOrder($transaction_id) {
    $headers = $this->headers();    
    $response = $this->request->api('GET', '/v2/transactions/orders/' . $transaction_id, null, $headers);

    return $response['body'];
  }

  /**
   * Create a new order transaction
   * http://developers.taxjar.com/api/?php#create-an-order-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function createOrder($parameters = array()) {
    $headers = $this->headers();
    $response = $this->request->api('POST', '/v2/transactions/orders', $parameters, $headers);

    return $response['body'];
  }

  /**
   * Update an existing order transaction
   * http://developers.taxjar.com/api/?php#update-an-order-transaction
   *
   * @param integer @transaction_id
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function updateOrder($transaction_id, $parameters = array()) {
    $headers = $this->headers();
    $response = $this->request->api('PUT', '/v2/transactions/orders/' . $transaction_id, $parameters, $headers);

    return $response['body'];
  }

  /**
   * Delete an existing order transaction
   * http://developers.taxjar.com/api/?php#delete-an-order-transaction
   *
   * @param integer $transaction_id
   *
   * @return object Order object.
   */
  public function deleteOrder($transaction_id) {
    $headers = $this->headers();
    $response = $this->request->api('DELETE', '/v2/transactions/orders/' . $transaction_id, null, $headers);

    return $response['body'];
  }

  /**
   * List refund transactions
   * http://developers.taxjar.com/api/?php#list-refund-transactions
   *
   * @param array $parameters
   *
   * @return object Refund collection.
   */
  public function listRefunds($parameters = array()) {
    $headers = $this->headers();
    $response = $this->request->api('GET', '/v2/transactions/refunds', $parameters, $headers);

    return $response['body'];
  }

  /**
   * Show refund transaction
   * http://developers.taxjar.com/api/?php#show-a-refund-transaction
   *
   * @param integer $transaction_id
   *
   * @return object Refund object.
   */
  public function showRefund($transaction_id) {
    $headers = $this->headers();
    $response = $this->request->api('GET', '/v2/transactions/refunds/' . $transaction_id, null, $headers);

    return $response['body'];
  }

  /**
   * Create a new refund transaction
   * http://developers.taxjar.com/api/?php#create-an-refund-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function createRefund($parameters = array()) {
    $headers = $this->headers();
    $response = $this->request->api('POST', '/v2/transactions/refunds', $parameters, $headers);

    return $response['body'];
  }

  /**
   * Update an order transaction
   * http://developers.taxjar.com/api/?php#update-an-refund-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function updateRefund($transaction_id, $parameters = array()) {
    $headers = $this->headers();
    $response = $this->request->api('PUT', '/v2/transactions/refunds/' . $transaction_id, $parameters, $headers);

    return $response['body'];
  }

  /**
   * Delete an existing refund transaction
   * http://developers.taxjar.com/api/?php#delete-a-refund-transaction
   *
   * @param integer $transaction_id
   *
   * @return object Refund object.
   */
  public function deleteRefund($transaction_id) {
    $headers = $this->headers();
    $response = $this->request->api('DELETE', '/v2/transactions/refunds/' . $transaction_id, null, $headers);

    return $response['body'];
  }
}