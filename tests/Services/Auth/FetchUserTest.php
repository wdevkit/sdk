<?php

namespace Wdevkit\Sdk\Tests\Services\Auth;

use PHPUnit\Framework\TestCase;

class FetchUserTest extends TestCase
{
    public function testItCastsFetchUserResponseToArray()
    {
        $mock = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], json_encode([
                'data' => [
                    'uuid' => 'a25d81de-8715-480e-a6cb-df24649e7479',
                    'name' => 'John Doe',
                    'email' => 'john@email.com',
                ],
            ])),
        ]);

        $handlerStack = \GuzzleHttp\HandlerStack::create($mock);

        $client = new \GuzzleHttp\Client(['handler' => $handlerStack]);

        $response = \Wdevkit\Sdk\Api::auth(['client' => $client])->fetchUser();

        $this->assertEquals([
            'data' => [
                'uuid' => 'a25d81de-8715-480e-a6cb-df24649e7479',
                'name' => 'John Doe',
                'email' => 'john@email.com',
            ],
        ], $response);
    }
}
