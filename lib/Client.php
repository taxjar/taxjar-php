<?php
namespace TaxJar;

class Client extends TaxJar
{
    public static function withApiKey($key)
    {
        return new Client($key);
    }

    public function __construct($key)
    {
        parent::__construct($key);
    }

    /**
     * Get tax categories
     * https://developers.taxjar.com/api/?php#list-tax-categories
     *
     * @return object Collection of tax categories.
     */
    public function categories()
    {
        $response = $this->client->get('categories');
        return json_decode($response->getBody())->categories;
    }

    /**
     * Get tax rates for a location
     * https://developers.taxjar.com/api/?php#show-tax-rates-for-a-location
     *
     * @param int $zip
     * @param array $parameters
     *
     * @return object Detailed rates for a specific location.
     */
    public function ratesForLocation($zip, $parameters = [])
    {
        $response = $this->client->get('rates/' . $zip, [
            'query' => $parameters,
        ]);
        return json_decode($response->getBody())->rate;
    }

    /**
     * Get sales tax for an order
     * https://developers.taxjar.com/api/?php#calculate-sales-tax-for-an-order
     *
     * @param array $parameters
     *
     * @return object Detailed sales tax breakdown for an order.
     */
    public function taxForOrder($parameters = [])
    {
        $response = $this->client->post('taxes', [
            'json' => $parameters,
        ]);
        return json_decode($response->getBody())->tax;
    }

    /**
     * List order transactions
     * https://developers.taxjar.com/api/?php#list-order-transactions
     *
     * @param array $parameters
     *
     * @return object Order collection.
     */
    public function listOrders($parameters = [])
    {
        $response = $this->client->get('transactions/orders', [
            'query' => $parameters,
        ]);
        return json_decode($response->getBody())->orders;
    }

    /**
     * Show order transaction
     * https://developers.taxjar.com/api/?php#show-an-order-transaction
     *
     * @param integer $transaction_id
     *
     * @return object Order object.
     */
    public function showOrder($transaction_id)
    {
        $response = $this->client->get('transactions/orders/' . $transaction_id);
        return json_decode($response->getBody())->order;
    }

    /**
     * Create a new order transaction
     * https://developers.taxjar.com/api/?php#create-an-order-transaction
     *
     * @param array $parameters
     *
     * @return object Order object.
     */
    public function createOrder($parameters = [])
    {
        $response = $this->client->post('transactions/orders', [
            'json' => $parameters,
        ]);
        return json_decode($response->getBody())->order;
    }

    /**
     * Update an existing order transaction
     * https://developers.taxjar.com/api/?php#update-an-order-transaction
     *
     * @param integer @transaction_id
     * @param array $parameters
     *
     * @return object Order object.
     */
    public function updateOrder($parameters = [])
    {
        $response = $this->client->put('transactions/orders/' . $parameters['transaction_id'], [
            'json' => $parameters,
        ]);
        return json_decode($response->getBody())->order;
    }

    /**
     * Delete an existing order transaction
     * https://developers.taxjar.com/api/?php#delete-an-order-transaction
     *
     * @param integer $transaction_id
     *
     * @return object Order object.
     */
    public function deleteOrder($transaction_id)
    {
        $response = $this->client->delete('transactions/orders/' . $transaction_id);
        return json_decode($response->getBody())->order;
    }

    /**
     * List refund transactions
     * https://developers.taxjar.com/api/?php#list-refund-transactions
     *
     * @param array $parameters
     *
     * @return object Refund collection.
     */
    public function listRefunds($parameters = [])
    {
        $response = $this->client->get('transactions/refunds', [
            'query' => $parameters,
        ]);
        return json_decode($response->getBody())->refunds;
    }

    /**
     * Show refund transaction
     * https://developers.taxjar.com/api/?php#show-a-refund-transaction
     *
     * @param integer $transaction_id
     *
     * @return object Refund object.
     */
    public function showRefund($transaction_id)
    {
        $response = $this->client->get('transactions/refunds/' . $transaction_id);
        return json_decode($response->getBody())->refund;
    }

    /**
     * Create a new refund transaction
     * https://developers.taxjar.com/api/?php#create-an-refund-transaction
     *
     * @param array $parameters
     *
     * @return object Order object.
     */
    public function createRefund($parameters = [])
    {
        $response = $this->client->post('transactions/refunds', [
            'json' => $parameters,
        ]);
        return json_decode($response->getBody())->refund;
    }

    /**
     * Update an order transaction
     * https://developers.taxjar.com/api/?php#update-an-refund-transaction
     *
     * @param array $parameters
     *
     * @return object Order object.
     */
    public function updateRefund($parameters = [])
    {
        $response = $this->client->put('transactions/refunds/' . $parameters['transaction_id'], [
            'json' => $parameters,
        ]);
        return json_decode($response->getBody())->refund;
    }

    /**
     * Delete an existing refund transaction
     * https://developers.taxjar.com/api/?php#delete-a-refund-transaction
     *
     * @param integer $transaction_id
     *
     * @return object Refund object.
     */
    public function deleteRefund($transaction_id)
    {
        $response = $this->client->delete('transactions/refunds/' . $transaction_id);
        return json_decode($response->getBody())->refund;
    }

    /**
     * List customers
     * https://developers.taxjar.com/api/?php#get-list-customers
     *
     * @param array $parameters
     *
     * @return object Customer collection.
     */
    public function listCustomers($parameters = [])
    {
        $response = $this->client->get('customers', [
            'query' => $parameters,
        ]);
        return json_decode($response->getBody())->customers;
    }

    /**
     * Show customer
     * https://developers.taxjar.com/api/?php#get-show-a-customer
     *
     * @param integer $customer_id
     *
     * @return object Customer object.
     */
    public function showCustomer($customer_id)
    {
        $response = $this->client->get('customers/' . $customer_id);
        return json_decode($response->getBody())->customer;
    }

    /**
     * Create a new customer
     * https://developers.taxjar.com/api/?php#post-create-a-customer
     *
     * @param array $parameters
     *
     * @return object Customer object.
     */
    public function createCustomer($parameters = [])
    {
        $response = $this->client->post('customers', [
            'json' => $parameters,
        ]);
        return json_decode($response->getBody())->customer;
    }

    /**
     * Update a customer
     * https://developers.taxjar.com/api/?php#put-update-a-customer
     *
     * @param integer @customer_id
     * @param array $parameters
     *
     * @return object Customer object.
     */
    public function updateCustomer($parameters = [])
    {
        $response = $this->client->put('customers/' . $parameters['customer_id'], [
            'json' => $parameters,
        ]);
        return json_decode($response->getBody())->customer;
    }

    /**
     * Delete a customer
     * https://developers.taxjar.com/api/?php#delete-delete-a-customer
     *
     * @param integer $customer_id
     *
     * @return object Customer object.
     */
    public function deleteCustomer($customer_id)
    {
        $response = $this->client->delete('customers/' . $customer_id);
        return json_decode($response->getBody())->customer;
    }

    /**
     * Get nexus regions
     * https://developers.taxjar.com/api/reference/?php#get-list-nexus-regions
     *
     * @return object Collection of nexus regions.
     */
    public function nexusRegions()
    {
        $response = $this->client->get('nexus/regions');
        return json_decode($response->getBody())->regions;
    }

    /**
     * Validate a VAT number
     * https://developers.taxjar.com/api/reference/?php#get-validate-a-vat-number
     *
     * @param array $parameters
     *
     * @return object Validation object.
     */
    public function validate($parameters = [])
    {
        $response = $this->client->get('validation', [
            'query' => $parameters,
        ]);
        return json_decode($response->getBody())->validation;
    }

    /**
     * Summarize tax rates for all regions
     * https://developers.taxjar.com/api/reference/?php#get-summarize-tax-rates-for-all-regions
     *
     * @return object Collection of summarized rates.
     */
    public function summaryRates()
    {
        $response = $this->client->get('summary_rates');
        return json_decode($response->getBody())->summary_rates;
    }
}
