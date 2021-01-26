<?php

namespace Wdevkit\Sdk;

class Api
{
    /**
     * Get checkout service api handler.
     *
     * @return \Wdevkit\Sdk\Services\Checkout\CheckoutService
     */
    public static function checkout($settings = [])
    {
        return (new \Wdevkit\Sdk\Services\Checkout\CheckoutService($settings));
    }

    /**
     * Get payments service api handler.
     *
     * @return \Wdevkit\Sdk\Services\Payments\PaymentsService
     */
    public static function payments($settings = [])
    {
        return (new \Wdevkit\Sdk\Services\Payments\PaymentsService($settings));
    }

    /**
     * Get payments service api handler.
     *
     * @return \Wdevkit\Sdk\Services\Auth\AuthService
     */
    public static function auth($settings = [])
    {
        return (new \Wdevkit\Sdk\Services\Auth\AuthService($settings));
    }
}
