<?php

namespace Wdevkit\Sdk\Tests\Services\Payments;

use PHPUnit\Framework\TestCase;

class PaymentsFetchTest extends TestCase
{
    public function testItCastFetchPaymentResponseToArray()
    {
        $mock = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], json_encode($this->fakePaymentFetchResponseData())),
        ]);

        $handlerStack = \GuzzleHttp\HandlerStack::create($mock);

        $client = new \GuzzleHttp\Client(['handler' => $handlerStack]);

        $response = \Wdevkit\Sdk\Api::payments(['client' => $client])->fetch('e253b6b1-37e2-4636-9d37-d280cdc5c163');

        $this->assertEquals($this->fakePaymentFetchResponseData(), $response);
    }

    public function fakePaymentFetchResponseData()
    {
        return [
            'data' => [
                'id' => 50,
                'uuid' => 'e253b6b1-37e2-4636-9d37-d280cdc5c163',
                'driver' => 'acme',
                'method' => 'credit_card',
                'state' => 'processed',
                'status' => 'success',
                'amount' => '119.0000',
                'installments' => 1,
                'description' => 'test payment',
                'recurring' => null,
                'customer' => [
                    'name' => 'John Doe',
                    'email' => 'johndoe@email.com',
                    'phone' => '999999999',
                    'document' => '999999999999'
                ]
            ]
        ];
    }
}
