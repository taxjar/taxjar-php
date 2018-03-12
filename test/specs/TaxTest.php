<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class TaxTest extends TaxJarTest
{
    public function testTaxForOrder()
    {
        $this->http->mock
            ->when()
            ->methodIs('POST')
            ->pathIs('/taxes')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/taxes.json"))
            ->end();

        $this->http->setUp();

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

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/taxes.json', json_encode([
            "tax" => $response
        ]));
    }
}
