<?php

namespace Tests\Unit;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ProductTest extends TestCase
{
    private $http;

    public function setUp():void
    {
        $this->http = new Client(["http_errors" => false]);
    }

    public function tearDown():void
    {
        $this->http = null;
    }

    public function testGetProductStatusCode()
    {
        $response = $this->http->request('GET', 'http://10.0.0.119:8000/api/product');
        $body = json_decode($response->getBody()->getContents());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($body);

    }

    public function testGetProductById()
    {
        $id = 1;
        $response = $this->http->request('GET', "http://10.0.0.119:8000/api/product/{$id}");
        $body = json_decode($response->getBody()->getContents());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, $body->id);

    }

    public function testDeleteProductById()
    {
        $id = 20;
        $response = $this->http->request('DELETE', "http://10.0.0.119:8000/api/product/{$id}");

        $this->assertEquals(200, $response->getStatusCode());

    }

}
