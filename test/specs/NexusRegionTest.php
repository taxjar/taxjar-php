<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class NexusRegionTest extends TaxJarTest
{
    public function testNexusRegions()
    {
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/nexus/regions')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/nexus_regions.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->nexusRegions();

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/nexus_regions.json', json_encode([
            "regions" => $response,
        ]));
    }
}
