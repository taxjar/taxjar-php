<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TaxJar\Tests\TaxJarTest;

class CustomerTest extends TaxJarTest
{
    public function testListCustomers()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/customers/list.json")));

        $response = $this->client->listCustomers();

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/customers', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/list.json', json_encode([
            "customers" => $response
        ]));
    }

    public function testShowCustomer()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/customers/show.json")));

        $response = $this->client->showCustomer(123);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/customers/123', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/show.json', json_encode([
            "customer" => $response
        ]));
    }

    public function testCreateCustomer()
    {
        $this->http->append(new Response(201, [], file_get_contents(__DIR__ . "/../fixtures/customers/show.json")));

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

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/customers', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/show.json', json_encode([
            "customer" => $response
        ]));
    }

    public function testUpdateCustomer()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/customers/show.json")));

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

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('/customers/123', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/show.json', json_encode([
            "customer" => $response
        ]));
    }

    public function testDeleteCustomer()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/customers/show.json")));

        $response = $this->client->deleteCustomer(123);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('/customers/123', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/customers/show.json', json_encode([
            "customer" => $response
        ]));
    }
}
