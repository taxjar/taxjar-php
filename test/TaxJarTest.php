<?php
require 'vendor/autoload.php';

class TaxJarTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass('8082', 'localhost');
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();
        $this->client = TaxJar\Client::withApiKey('test');
        $this->client->setApiConfig('base_uri', 'http://localhost:8082');
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }
}
