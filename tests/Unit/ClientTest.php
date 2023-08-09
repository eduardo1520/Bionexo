<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ClientTest extends TestCase
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

    public function testGetClientStatusCode()
    {
        $response = $this->http->request('GET', 'http://10.0.0.119:8000/api/client');
        $body = json_decode($response->getBody()->getContents());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($body);

    }

    public function testGetClientById()
    {
        $id = 1;
        $response = $this->http->request('GET', "http://10.0.0.119:8000/api/client/{$id}");
        $body = json_decode($response->getBody()->getContents());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, $body->id);

    }

    public function testDeleteClientById()
    {
        $id = 20;
        $response = $this->http->request('DELETE', "http://10.0.0.119:8000/api/client/{$id}");

        $this->assertEquals(200, $response->getStatusCode());

    }

}
