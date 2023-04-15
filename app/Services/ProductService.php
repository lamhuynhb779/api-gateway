<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;

class ProductService
{
    use RequestService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('internal_services.products.base_uri');
        $this->secret  = config('internal_services.products.secret');
    }

    /**
     * @throws GuzzleException
     */
    public function fetchAll()
    {
        return $this->request('GET', '/api/products');
    }

    /**
     * @throws GuzzleException
     */
    public function fetch($product): string
    {
        return $this->request('GET', "/api/products/{$product}");
    }

    /**
     * @throws GuzzleException
     */
    public function create($data): string
    {
        return $this->request('POST', '/api/products', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function update($product, $data): string
    {
        return $this->request('PATCH', "/api/products/{$product}", $data);
    }

    /**
     * @throws GuzzleException
     */
    public function delete($product): string
    {
        return $this->request('DELETE', "/api/products/{$product}");
    }

}
