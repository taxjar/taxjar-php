<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TaxJar\Tests\TaxJarTest;

class TransactionTest extends TaxJarTest
{
    public function testListOrders()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/orders/list.json")));

        $response = $this->client->listOrders([
            'from_transaction_date' => '2015/05/01',
            'to_transaction_date' => '2015/05/31',
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/transactions/orders', $request->getUri()->getPath());
        $this->assertSame('from_transaction_date=2015%2F05%2F01&to_transaction_date=2015%2F05%2F31', $request->getUri()->getQuery());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/list.json', json_encode([
            "orders" => $response
        ]));
    }

    public function testShowOrder()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/orders/show.json")));

        $response = $this->client->showOrder(123);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/transactions/orders/123', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode([
            "order" => $response
        ]));
    }

    public function testShowOrderWithParams()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/orders/show.json")));

        $response = $this->client->showOrder(123, [
            'provider' => 'api',
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/transactions/orders/123', $request->getUri()->getPath());
        $this->assertSame('provider=api', $request->getUri()->getQuery());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode([
            "order" => $response
        ]));
    }

    public function testCreateOrder()
    {
        $this->http->append(new Response(201, [], file_get_contents(__DIR__ . "/../fixtures/orders/show.json")));

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
                    'sales_tax' => 0.95,
                ],
            ],
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/transactions/orders', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode([
            "order" => $response
        ]));
    }

    public function testUpdateOrder()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/orders/show.json")));

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
                    'sales_tax' => 0.95,
                ],
            ],
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('/transactions/orders/123', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode([
            "order" => $response
        ]));
    }

    public function testDeleteOrder()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/orders/show.json")));

        $response = $this->client->deleteOrder(123);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('/transactions/orders/123', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode([
            "order" => $response
        ]));
    }

    public function testDeleteOrderWithParams()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/orders/show.json")));

        $response = $this->client->deleteOrder(123, [
            'provider' => 'api',
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('/transactions/orders/123', $request->getUri()->getPath());
        $this->assertSame('provider=api', $request->getUri()->getQuery());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/orders/show.json', json_encode([
            "order" => $response
        ]));
    }

    public function testListRefunds()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/refunds/list.json")));

        $response = $this->client->listRefunds([
            'from_transaction_date' => '2015/05/01',
            'to_transaction_date' => '2015/05/31',
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/transactions/refunds', $request->getUri()->getPath());
        $this->assertSame('from_transaction_date=2015%2F05%2F01&to_transaction_date=2015%2F05%2F31', $request->getUri()->getQuery());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/list.json', json_encode([
            "refunds" => $response
        ]));
    }

    public function testShowRefund()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/refunds/show.json")));

        $response = $this->client->showRefund(321);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/transactions/refunds/321', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode([
            "refund" => $response
        ]));
    }

    public function testShowRefundWithParams()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/refunds/show.json")));

        $response = $this->client->showRefund(321, [
            'provider' => 'api',
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/transactions/refunds/321', $request->getUri()->getPath());
        $this->assertSame('provider=api', $request->getUri()->getQuery());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode([
            "refund" => $response
        ]));
    }

    public function testCreateRefund()
    {
        $this->http->append(new Response(201, [], file_get_contents(__DIR__ . "/../fixtures/refunds/show.json")));

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
                    'sales_tax' => 0.95,
                ],
            ],
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/transactions/refunds', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode([
            "refund" => $response
        ]));
    }

    public function testUpdateRefund()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/refunds/show.json")));

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
                    'sales_tax' => 0.95,
                ],
            ],
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('/transactions/refunds/321', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode([
            "refund" => $response
        ]));
    }

    public function testDeleteRefund()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/refunds/show.json")));

        $response = $this->client->deleteRefund(321);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('/transactions/refunds/321', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode([
            "refund" => $response
        ]));
    }

    public function testDeleteRefundWithParams()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/refunds/show.json")));

        $response = $this->client->deleteRefund(321, [
            'provider' => 'api',
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('/transactions/refunds/321', $request->getUri()->getPath());
        $this->assertSame('provider=api', $request->getUri()->getQuery());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/refunds/show.json', json_encode([
            "refund" => $response
        ]));
    }
}
