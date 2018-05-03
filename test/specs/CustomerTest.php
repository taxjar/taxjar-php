<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class CustomerTest extends TaxJarTest
{
    public function testListCustomers()
    {
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/customers')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/customers/list.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->listCustomers();

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/list.json', json_encode([
            "customers" => $response
        ]));
    }

    public function testShowCustomer()
    {
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/customers/123')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/customers/show.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->showCustomer(123);

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/show.json', json_encode([
            "customer" => $response
        ]));
    }

    public function testCreateCustomer()
    {
        $this->http->mock
            ->when()
            ->methodIs('POST')
            ->pathIs('/customers')
            ->then()
            ->statusCode(201)
            ->body(file_get_contents(__DIR__ . "/../fixtures/customers/show.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->createCustomer([
            'customer_id' => '123',
            'exemption_type' => 'wholesale',
            'name' => 'Dunder Mifflin Paper Company',
            'exempt_regions' => [
              [
                'country' => 'US',
                'state' => 'FL'
              ],
              [
                'country' => 'US',
                'state' => 'PA'
              ]
            ],
            'country' => 'US',
            'state' => 'PA',
            'zip' => '18504',
            'city' => 'Scranton',
            'street' => '1725 Slough Avenue'
        ]);

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/show.json', json_encode([
            "customer" => $response
        ]));
    }

    public function testUpdateCustomer()
    {
        $this->http->mock
            ->when()
            ->methodIs('PUT')
            ->pathIs('/customers/123')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/customers/show.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->updateCustomer([
            'customer_id' => '123',
            'exemption_type' => 'wholesale',
            'name' => 'Sterling Cooper',
            'exempt_regions' => [
              [
                'country' => 'US',
                'state' => 'NY'
              ]
            ],
            'country' => 'US',
            'state' => 'NY',
            'zip' => '10010',
            'city' => 'New York',
            'street' => '405 Madison Ave'
        ]);

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/show.json', json_encode([
            "customer" => $response
        ]));
    }

    public function testDeleteCustomer()
    {
        $this->http->mock
            ->when()
            ->methodIs('DELETE')
            ->pathIs('/customers/123')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/customers/show.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->deleteCustomer(123);

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/show.json', json_encode([
            "customer" => $response
        ]));
    }
}
