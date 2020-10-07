<?php

namespace Wdevkit\Sdk\Tests\Services\Payments;

use PHPUnit\Framework\TestCase;

class PaymentsMethodsFetchTest extends TestCase
{
    public function testItSetsPaymentServiceSettingsOnNewInstance()
    {
        $payment = \Wdevkit\Sdk\Api::payments([
            'base_uri' => 'https://payment.test.dev',
            'token' => 'some_token',
        ]);

        $this->assertEquals('https://payment.test.dev', $payment->getBaseUri());
        $this->assertEquals('some_token', $payment->getToken());
    }

    public function testItCastFetchPaymentMethodsResponseToArray()
    {
        $mock = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], json_encode([
                'data' => [
                    'methods' => [
                        ['code' => 'foo', 'title' => 'Foo', 'driver' => 'foov1'],
                        ['code' => 'far', 'title' => 'Bar', 'driver' => 'barv1'],
                    ]
                ],
            ])),
        ]);

        $handlerStack = \GuzzleHttp\HandlerStack::create($mock);

        $client = new \GuzzleHttp\Client(['handler' => $handlerStack]);

        $response = \Wdevkit\Sdk\Api::payments(['client' => $client])->fetchMethods([]);

        $this->assertEquals([
            'data' => [
                'methods' => [
                    ['code' => 'foo', 'title' => 'Foo', 'driver' => 'foov1'],
                    ['code' => 'far', 'title' => 'Bar', 'driver' => 'barv1'],
                ]
            ]
        ], $response);
    }
}
