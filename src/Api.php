<?php

namespace Wdevkit\Sdk;

class Api
{
    /**
     * Get checkout service api handler.
     *
     * @return \Wdevkit\Sdk\Services\Checkout\CheckoutService
     */
    static public function checkout($settings = [])
    {
        return (new \Wdevkit\Sdk\Services\Checkout\CheckoutService($settings));
    }
}
