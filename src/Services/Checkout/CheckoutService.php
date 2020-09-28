<?php

namespace Wdevkit\Sdk\Services\Checkout;

use Wdevkit\Sdk\Services\BaseService;

class CheckoutService extends BaseService
{
    /**
     * Create a checkout on Checkout Service.
     *
     * @param  array  $data
     * @return array
     */
    public function create($data = [])
    {
        return $this->makeResponse(
            $this->client->request('POST', "{$this->baseUri}/api/v1/checkouts", ['json' => $data])
        );
    }
}
