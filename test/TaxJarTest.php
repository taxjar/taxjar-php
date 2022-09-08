<?php

namespace TaxJar\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use PHPUnit\Framework\TestCase;
use TaxJar\Client;

abstract class TaxJarTest extends TestCase
{
    protected $history = [];

    /** @var MockHandler */
    protected $http;

    /** @var Client */
    protected $client;

    public function setUp(): void
    {
        $this->http = new MockHandler();
        $handler = HandlerStack::create($this->http);
        $handler->push(Middleware::history($this->history));

        $this->client = Client::withApiKey('test');
        $this->client->setApiConfig('handler', $handler);
        $this->client->setApiConfig('base_uri', 'http://localhost:8082');
    }
}
