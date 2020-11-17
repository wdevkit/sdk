<?php

namespace Wdevkit\Sdk\Services\Payments;

use Wdevkit\Sdk\Services\BaseService;

class PaymentsService extends BaseService
{
    /**
     * Fetch payment methods on Payments Service.
     *
     * @param  array  $data
     * @return array
     */
    public function fetchMethods($data = [])
    {
        return $this->makeResponse(
            $this->client->request('GET', "{$this->baseUri}/api/v1/payments/methods", ['json' => $data])
        );
    }

    /**
     * Create a payment on Payments Service.
     *
     * @param  array  $data
     * @return array
     */
    public function create($data = [])
    {
        return $this->makeResponse(
            $this->client->request('POST', "{$this->baseUri}/api/v1/payments", ['json' => $data])
        );
    }

    /**
     * Fetch a payment on Payments Service.
     *
     * @param  string $uuid
     * @return array
     */
    public function fetch($uuid)
    {
        return $this->makeResponse(
            $this->client->request('GET', "{$this->baseUri}/api/v1/payments/{$uuid}")
        );
    }
}
