<?php
if (!class_exists('TaxJarTest')) {
    require __DIR__ . '/../TaxJarTest.php';
}

class CategoryTest extends TaxJarTest
{
    public function testCategories()
    {
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/categories')
            ->then()
            ->statusCode(200)
            ->body(file_get_contents(__DIR__ . "/../fixtures/categories.json"))
            ->end();

        $this->http->setUp();

        $response = $this->client->categories();

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../fixtures/categories.json', json_encode([
            "categories" => $response
        ]));
    }
}
