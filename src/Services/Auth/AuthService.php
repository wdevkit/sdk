<?php

namespace Wdevkit\Sdk\Services\Auth;

use Wdevkit\Sdk\Services\BaseService;

class AuthService extends BaseService
{
    /**
     * Create a checkout on Checkout Service.
     *
     * @param  array  $data
     * @return array
     */
    public function fetchUser($query = [])
    {
        return $this->makeResponse(
            $this->client->request('GET', "{$this->baseUri}/sanctum/user", ['query' => $query])
        );
    }
}
