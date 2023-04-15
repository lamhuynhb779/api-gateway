<?php

return [
    'products' => [
        'base_uri' => env('PRODUCTS_SERVICE_BASE_URI', 'http://localhost:8001/api'),
        'secret' => env('PRODUCTS_SERVICE_SECRET', 'mysecret1')
    ],
    'orders' => [
        'base_uri' => env('ORDERS_SERVICE_BASE_URI', 'http://localhost:8002/api'),
        'secret' => env('ORDERS_SERVICE_SECRET', 'mysecret2'),
    ]
];

