<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @throws GuzzleException
     */
    public function index()
    {
        return $this->successResponse($this->orderService->fetchAll());
    }

    /**
     * @throws GuzzleException
     */
    public function show($order)
    {
        return $this->successResponse($this->orderService->fetch($order));
    }

    /**
     * @throws GuzzleException
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->orderService->create($request->all()));
    }

    /**
     * @throws GuzzleException
     */
    public function update(Request $request, $order)
    {
        return $this->successResponse($this->orderService->update($order, $request->all()));
    }

    /**
     * @throws GuzzleException
     */
    public function destroy($order)
    {
        return $this->successResponse($this->orderService->delete($order));
    }
}
