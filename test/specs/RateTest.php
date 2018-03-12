<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class RateTest extends TaxJarTest
{
    public function testRatesForLocation()
    {
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/rates/90002')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/rates.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->ratesForLocation(90002);

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/rates.json', json_encode([
            "rate" => $response,
        ]));
    }
}
