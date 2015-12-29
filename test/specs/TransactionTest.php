<?php
if (!class_exists('TaxJarTest')) {
  require __DIR__ . '/../TaxJarTest.php';
}

class TransactionTest extends TaxJarTest {
  public function test_list_orders() {
    $this->http->mock
        ->when()
            ->methodIs('GET')
            ->pathIs('/transactions/orders?from_transaction_date=2015%2F05%2F01&to_transaction_date=2015%2F05%2F31')
        ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/orders/list.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->listOrders([
      'from_transaction_date' => '2015/05/01',
      'to_transaction_date' => '2015/05/31'
    ]);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/list.json', json_encode(["orders" => $response]));
  }
  
  public function test_show_order() {
    $this->http->mock
        ->when()
            ->methodIs('GET')
            ->pathIs('/transactions/orders/123')
        ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/orders/show.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->showOrder(123);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode(["order" => $response]));
  }
  
  public function test_create_order() {
    $this->http->mock
        ->when()
            ->methodIs('POST')
            ->pathIs('/transactions/orders')
        ->then()
            ->statusCode(201)
            ->body(file_get_contents(__DIR__ . "/../fixtures/orders/show.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->createOrder([
      'transaction_id' => '123',
      'transaction_date' => '2015/05/14',
      'to_country' => 'US',
      'to_zip' => '90002',
      'to_state' => 'CA',
      'to_city' => 'Los Angeles',
      'to_street' => '123 Palm Grove Ln',
      'amount' => 17.45,
      'shipping' => 1.5,
      'sales_tax' => 0.95,
      'line_items' => [
        [
          'quantity' => 1,
          'product_identifier' => '12-34243-9',
          'description' => 'Fuzzy Widget',
          'unit_price' => 15.0,
          'sales_tax' => 0.95
        ]
      ]
    ]);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode(["order" => $response]));
  }
  
  public function test_update_order() {
    $this->http->mock
        ->when()
            ->methodIs('PUT')
            ->pathIs('/transactions/orders/123')
        ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/orders/show.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->updateOrder([
      'transaction_id' => '123',
      'amount' => 17.95,
      'shipping' => 2.0,
      'line_items' => [
        [
          'quantity' => 1,
          'product_identifier' => '12-34243-0',
          'description' => 'Heavy Widget',
          'unit_price' => 15.0,
          'discount' => 0.0,
          'sales_tax' => 0.95
        ]
      ]
    ]);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode(["order" => $response]));
  }
  
  public function test_delete_order() {
    $this->http->mock
        ->when()
            ->methodIs('DELETE')
            ->pathIs('/transactions/orders/123')
        ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/orders/show.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->deleteOrder(123);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode(["order" => $response]));
  }
  
  public function test_list_refunds() {
    $this->http->mock
        ->when()
            ->methodIs('GET')
            ->pathIs('/transactions/refunds?from_transaction_date=2015%2F05%2F01&to_transaction_date=2015%2F05%2F31')
        ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/refunds/list.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->listRefunds([
      'from_transaction_date' => '2015/05/01',
      'to_transaction_date' => '2015/05/31'
    ]);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/list.json', json_encode(["refunds" => $response]));
  }
  
  public function test_show_refund() {
    $this->http->mock
        ->when()
            ->methodIs('GET')
            ->pathIs('/transactions/refunds/321')
        ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/refunds/show.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->showRefund(321);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode(["refund" => $response]));
  }
  
  public function test_create_refund() {
    $this->http->mock
        ->when()
            ->methodIs('POST')
            ->pathIs('/transactions/refunds')
        ->then()
            ->statusCode(201)
            ->body(file_get_contents(__DIR__ . "/../fixtures/refunds/show.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->createRefund([
      'transaction_id' => '321',
      'transaction_date' => '2015/05/14',
      'transaction_reference_id' => '123',
      'to_country' => 'US',
      'to_zip' => '90002',
      'to_state' => 'CA',
      'to_city' => 'Los Angeles',
      'to_street' => '123 Palm Grove Ln',
      'amount' => 17.45,
      'shipping' => 1.5,
      'sales_tax' => 0.95,
      'line_items' => [
        [
          'quantity' => 1,
          'product_identifier' => '12-34243-9',
          'description' => 'Fuzzy Widget',
          'unit_price' => 15.0,
          'sales_tax' => 0.95
        ]
      ]
    ]);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode(["refund" => $response]));
  }
  
  public function test_update_refund() {
    $this->http->mock
        ->when()
            ->methodIs('PUT')
            ->pathIs('/transactions/refunds/321')
        ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/refunds/show.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->updateRefund([
      'transaction_id' => '321',
      'amount' => 17.95,
      'shipping' => 2.0,
      'line_items' => [
        [
          'quantity' => 1,
          'product_identifier' => '12-34243-0',
          'description' => 'Heavy Widget',
          'unit_price' => 15.0,
          'sales_tax' => 0.95
        ]
      ]
    ]);
    
    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode(["refund" => $response]));
  }
  
  public function test_delete_refund() {
    $this->http->mock
        ->when()
            ->methodIs('DELETE')
            ->pathIs('/transactions/refunds/321')
        ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/refunds/show.json"))
        ->end();

    $this->http->setUp();
    
    $response = $this->client->deleteRefund(321);

    $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode(["refund" => $response]));
  }
}