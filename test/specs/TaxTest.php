<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TaxJar\Tests\TaxJarTest;

class TaxTest extends TaxJarTest
{
    public function testTaxForOrder()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/taxes.json")));

        $response = $this->client->taxForOrder([
            'from_country' => 'US',
            'from_zip' => '07001',
            'from_state' => 'NJ',
            'to_country' => 'US',
            'to_zip' => '07446',
            'to_state' => 'NJ',
            'amount' => 16.50,
            'shipping' => 1.5,
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/taxes', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/taxes.json', json_encode([
            "tax" => $response
        ]));
    }
}
