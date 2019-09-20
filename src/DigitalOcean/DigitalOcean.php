<?php

namespace Snelstart;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Snelstart
{
    protected $path = 'https://api.digitalocean.com/v2/';
    protected $apiKey;

    protected function headers(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey,
        ];
    }

    /**
     * @param $uri
     * @param string $method
     * @param null $body
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($uri, $method = 'GET', $body = null)
    {
        $client = new Client();
        $request = new Request($method, $this->path.$uri, $this->headers(), $body);
        $response = $client->send($request, ['timeout' => 60, 'verify' => false]);
        return json_decode($response->getBody()->getContents(), 1);
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }
}