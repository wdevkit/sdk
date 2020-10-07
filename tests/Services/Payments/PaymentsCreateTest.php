<?php

namespace Wdevkit\Sdk\Tests\Services\Payments;

use PHPUnit\Framework\TestCase;

class PaymentsCreateTest extends TestCase
{
    public function testItCastCreatePaymentResponseToArray()
    {
        $mock = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], json_encode($this->fakePaymentResponseData())),
        ]);

        $handlerStack = \GuzzleHttp\HandlerStack::create($mock);

        $client = new \GuzzleHttp\Client(['handler' => $handlerStack]);

        $response = \Wdevkit\Sdk\Api::payments(['client' => $client])->create($this->fakePaymentRequestData());

        $this->assertEquals($this->fakePaymentResponseData(), $response);
    }

    public function fakePaymentRequestData()
    {
        return [
            'customer' => ['name' => 'John Doe', 'document' => '12345678909', 'email' => 'johndoe@email.com'],
            'payment' => [
                'description' => 'credit card test from wdevkit/sdk',
                'method' => 'credit_card',
                'amount' => 42,
                'installments' => 1,
                'credit_card' => [
                    'card_number' => '1111 1111 1111 1111',
                    'brand' => 'visa',
                    'expiration_date' => '10/2026',
                    'security_code' => 123,
                    'holder' => 'John Doe'
                ]
            ]
        ];
    }

    public function fakePaymentResponseData()
    {
        return [
            'data' => [
                'payment_uuid' => 'fb624d85-5a13-47c7-8ea7-b917490d5e12',
                'payment_method' => 'credit_card',
                'amount' => '42',
                'state' => 'processed',
                'status' => 'success',
                'errors' => null,
                'actions' => [
                    ['title' => 'Refund', 'code' => 'refund', 'url' => 'https://refund_route'],
                    ['title' => 'Details', 'code' => 'details', 'url' => 'https://details_route'],
                ],
            ]
        ];
    }
}
