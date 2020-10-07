<?php

namespace Wdevkit\Sdk\Tests;

use PHPUnit\Framework\TestCase;

class SdkTest extends TestCase
{
    public function testItHaveCheckoutServiceAccessor()
    {
        $this->assertInstanceOf(\Wdevkit\Sdk\Services\Checkout\CheckoutService::class, \Wdevkit\Sdk\Api::checkout());
    }

    public function testItHavePaymentServiceAccessor()
    {
        $this->assertInstanceOf(\Wdevkit\Sdk\Services\Payments\PaymentsService::class, \Wdevkit\Sdk\Api::payments());
    }
}
