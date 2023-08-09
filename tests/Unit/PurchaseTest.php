<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class PurchaseTest extends TestCase
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

    public function testGetPurchaseStatusCode()
    {
        $response = $this->http->request('GET', 'http://10.0.0.119:8000/api/purchase');
        $body = json_decode($response->getBody()->getContents());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($body);

    }

    public function testGetPurchaseById()
    {
        $id = 1;
        $response = $this->http->request('GET', "http://10.0.0.119:8000/api/purchase/{$id}");
        $body = json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, $body[0]->id);

    }

    public function testDeletePurchaseById()
    {
        $id = 20;
        $response = $this->http->request('DELETE', "http://10.0.0.119:8000/api/purchase/{$id}");

        $this->assertEquals(200, $response->getStatusCode());

    }
}
