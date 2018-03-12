<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class SummaryRateTest extends TaxJarTest
{
    public function testSummaryRates()
    {
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/summary_rates')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/summary_rates.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->summaryRates();

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/summary_rates.json', json_encode([
            "summary_rates" => $response
        ]));
    }
}
