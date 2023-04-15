<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;

class OrderService
{
    use RequestService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('internal_services.orders.base_uri');
        $this->secret = config('internal_services.orders.secret');
    }

    /**
     * @throws GuzzleException
     */
    public function fetchAll(): string
    {
        return $this->request('GET', '/api/orders');
    }

    /**
     * @throws GuzzleException
     */
    public function fetch($order): string
    {
        return $this->request('GET', "/api/orders/{$order}");
    }

    /**
     * @throws GuzzleException
     */
    public function create($data): string
    {
        return $this->request('POST', '/api/orders', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function update($order, $data): string
    {
        return $this->request('PATCH', "/api/orders/{$order}", $data);
    }

    /**
     * @throws GuzzleException
     */
    public function delete($order): string
    {
        return $this->request('DELETE', "/api/orders/{$order}");
    }
}
