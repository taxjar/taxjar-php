<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TaxJar\Tests\TaxJarTest;

class NexusRegionTest extends TaxJarTest
{
    public function testNexusRegions()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/nexus_regions.json")));

        $response = $this->client->nexusRegions();

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/nexus/regions', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/nexus_regions.json', json_encode([
            "regions" => $response,
        ]));
    }
}
