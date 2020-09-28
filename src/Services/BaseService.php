<?php

namespace Wdevkit\Sdk\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class BaseService
{
    /**
     * Service base uri.
     *
     * @var string
     */
    protected $baseUri;

    /**
     * Service token
     *
     * @var string
     */
    protected $token;

    /**
     * Guzzle http client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    public function __construct($settings)
    {
        if (isset($settings['base_uri'])) {
            $this->setBaseUri($settings['base_uri']);
        }

        if (isset($settings['token'])) {
            $this->setToken($settings['token']);
        }

        if (isset($settings['client'])) {
            $this->setClient($settings['client']);
        } else {
            $this->client = new \GuzzleHttp\Client([
                'headers' => [
                    'User-Agent' => 'wdevkit/sdk:1.x',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getToken(),
                ],
            ]);
        }
    }

    /**
     * Set service base uri.
     *
     * @param string $uri
     */
    public function setBaseUri($uri)
    {
        $this->baseUri = $uri;

        return $this;
    }

    /**
     * Set service request token.
     *
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Set service request client instance.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get service base uri.
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * Get service request token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Make response method to standardize respones.
     *
     * @param  \GuzzleHttp\Psr7\Response $response
     * @return array
     */
    public function makeResponse(Response $response)
    {
        return json_decode((string)$response->getBody(), true);
    }
}
