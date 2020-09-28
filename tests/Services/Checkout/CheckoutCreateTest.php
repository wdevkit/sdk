<?php

namespace Wdevkit\Sdk\Tests\Services\Checkout;

use PHPUnit\Framework\TestCase;

class CheckoutCreateTest extends TestCase
{
    public function testItSetsCheckoutServiceSettingsOnNewInstance()
    {
        $checkout = \Wdevkit\Sdk\Api::checkout([
            'base_uri' => 'https://checkout.test.dev',
            'token' => 'some_token'
        ]);

        $this->assertEquals('https://checkout.test.dev', $checkout->getBaseUri());
        $this->assertEquals('some_token', $checkout->getToken());
    }

    public function testItCastsCreateCheckoutResponseToArray()
    {
        $mock = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], json_encode([
                'data' => [
                    'uuid' => '2dcdf759-1ba1-4d25-aca9-9c0c11224cfd',
                    'actions' => [
                        'get' => 'https://checkout.test.dev/checkouts/2dcdf759-1ba1-4d25-aca9-9c0c11224cfd/profiles',
                    ]
                ]
            ])),
        ]);

        $handlerStack = \GuzzleHttp\HandlerStack::create($mock);

        $client = new \GuzzleHttp\Client(['handler' => $handlerStack]);

        $response = \Wdevkit\Sdk\Api::checkout(['client' => $client])->create([]);

        $this->assertEquals([
            'data' => [
                'uuid' => '2dcdf759-1ba1-4d25-aca9-9c0c11224cfd',
                'actions' => [
                    'get' => 'https://checkout.test.dev/checkouts/2dcdf759-1ba1-4d25-aca9-9c0c11224cfd/profiles',
                ]
            ]
        ], $response);
    }
}
