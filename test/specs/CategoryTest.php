<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TaxJar\Tests\TaxJarTest;

class CategoryTest extends TaxJarTest
{
    public function testCategories()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/categories.json")));

        $response = $this->client->categories();

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/categories', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/categories.json', json_encode([
            "categories" => $response
        ]));
    }
}
