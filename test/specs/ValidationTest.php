<?php

namespace TaxJar\Tests\specs;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TaxJar\Tests\TaxJarTest;

class ValidationTest extends TaxJarTest
{
    public function testValidateAddress()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/addresses.json")));

        $response = $this->client->validateAddress([
            'country' => 'US',
            'state' => 'AZ',
            'zip' => '85297',
            'city' => 'Gilbert',
            'street' => '3301 South Greenfield Rd'
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/addresses/validate', $request->getUri()->getPath());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/addresses.json', json_encode([
            "addresses" => $response
        ]));
    }

    public function testValidation()
    {
        $this->http->append(new Response(200, [], file_get_contents(__DIR__ . "/../fixtures/validation.json")));

        $response = $this->client->validate([
            'vat' => 'FR40303265045',
        ]);

        $this->assertCount(1, $this->history);

        /** @var Request $request */
        $request = reset($this->history)['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/validation', $request->getUri()->getPath());
        $this->assertSame('vat=FR40303265045', $request->getUri()->getQuery());

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/validation.json', json_encode([
            "validation" => $response
        ]));
    }
}
