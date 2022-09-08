<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TaxJar\Tests\TaxJarTest;

class RateTest extends TaxJarTest
{
    public function testRatesForLocation()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/rates.json")));

        $response = $this->client->ratesForLocation(90002);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/rates/90002', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/rates.json', json_encode([
            "rate" => $response,
        ]));
    }
}
