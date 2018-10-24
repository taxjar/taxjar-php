<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class ValidationTest extends TaxJarTest
{
    public function testValidateAddress()
    {
        $this->http->mock
            ->when()
            ->methodIs('POST')
            ->pathIs('/addresses/validate')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/addresses.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->validateAddress([
            'country' => 'US',
            'state' => 'AZ',
            'zip' => '85297',
            'city' => 'Gilbert',
            'street' => '3301 South Greenfield Rd'
        ]);

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/addresses.json', json_encode([
            "addresses" => $response
        ]));
    }

    public function testValidation()
    {
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/validation?vat=FR40303265045')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/validation.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->validate([
            'vat' => 'FR40303265045',
        ]);

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/validation.json', json_encode([
            "validation" => $response
        ]));
    }
}
