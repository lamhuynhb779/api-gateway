<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait RequestService
{
    public $baseUri;
    public $secret;

    /**
     * @throws GuzzleException
     */
    public function request($method, $requestUrl, $formParams = [], $headers = []): string
    {
        $client = new Client([
            'base_uri'  => $this->baseUri
        ]);
        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUrl, [
            'form_params'   => $formParams,
            'headers'       => $headers,
        ]);

        return $response->getBody()->getContents();
    }
}
