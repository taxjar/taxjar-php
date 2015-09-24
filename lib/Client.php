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
    $response = $this->client->get('categories');
    return json_decode($response->getBody());
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
  public function ratesForLocation($zip, $parameters = []) {
    $response = $this->client->get('rates/' . $zip, [
      'json' => $parameters
    ]);
    return json_decode($response->getBody());
  }

  /**
   * Get sales tax for an order
   * http://developers.taxjar.com/api/?php#calculate-sales-tax-for-an-order
   *
   * @param array $parameters
   *
   * @return object Detailed sales tax breakdown for an order.
   */
  public function taxForOrder($parameters = []) {
    $response = $this->client->post('taxes', [
      'json' => $parameters
    ]);
    return json_decode($response->getBody());
  }

  /**
   * List order transactions
   * http://developers.taxjar.com/api/?php#list-order-transactions
   *
   * @param array $parameters
   *
   * @return object Order collection.
   */
  public function listOrders($parameters = []) {
    $response = $this->client->get('transactions/orders', [
      'json' => $parameters
    ]);
    return json_decode($response->getBody());
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
    $response = $this->client->get('transactions/orders/' . $transaction_id);
    return json_decode($response->getBody());
  }

  /**
   * Create a new order transaction
   * http://developers.taxjar.com/api/?php#create-an-order-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function createOrder($parameters = []) {
    $response = $this->client->post('transactions/orders', [
      'json' => $parameters
    ]);
    return json_decode($response->getBody());
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
  public function updateOrder($parameters = []) {
    $response = $this->client->put('transactions/orders/' . $parameters['transaction_id'], [
      'json' => $parameters
    ]);
    return json_decode($response->getBody());
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
    $response = $this->client->delete('transactions/orders/' . $transaction_id);
    return json_decode($response->getBody());
  }

  /**
   * List refund transactions
   * http://developers.taxjar.com/api/?php#list-refund-transactions
   *
   * @param array $parameters
   *
   * @return object Refund collection.
   */
  public function listRefunds($parameters = []) {
    $response = $this->client->get('transactions/refunds', [
      'json' => $parameters
    ]);
    return json_decode($response->getBody());
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
    $response = $this->client->get('transactions/refunds/' . $transaction_id);
    return json_decode($response->getBody());
  }

  /**
   * Create a new refund transaction
   * http://developers.taxjar.com/api/?php#create-an-refund-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function createRefund($parameters = []) {
    $response = $this->client->post('transactions/refunds', [
      'json' => $parameters
    ]);
    return json_decode($response->getBody());
  }

  /**
   * Update an order transaction
   * http://developers.taxjar.com/api/?php#update-an-refund-transaction
   *
   * @param array $parameters
   *
   * @return object Order object.
   */
  public function updateRefund($parameters = []) {
    $response = $this->client->put('transactions/refunds/' . $parameters['transaction_id'], [
      'json' => $parameters
    ]);
    return json_decode($response->getBody());
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
    $response = $this->client->delete('transactions/refunds/' . $transaction_id);
    return json_decode($response->getBody());
  }
}