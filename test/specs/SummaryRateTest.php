<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TaxJar\Tests\TaxJarTest;

class SummaryRateTest extends TaxJarTest
{
    public function testSummaryRates()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/summary_rates.json")));

        $response = $this->client->summaryRates();

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/summary_rates', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/summary_rates.json', json_encode([
            "summary_rates" => $response
        ]));
    }
}
