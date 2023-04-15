<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @throws GuzzleException
     */
    public function index()
    {
        return $this->successResponse($this->productService->fetchAll());
    }

    /**
     * @throws GuzzleException
     */
    public function show($product)
    {
        return $this->successResponse($this->productService->fetch($product));
    }

    /**
     * @throws GuzzleException
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->productService->create($request->all()));
    }

    /**
     * @throws GuzzleException
     */
    public function update(Request $request, $product)
    {
        return $this->successResponse($this->productService->update($product, $request->all()));
    }

    /**
     * @throws GuzzleException
     */
    public function destroy($product)
    {
        return $this->successResponse($this->productService->delete($product));
    }
}
