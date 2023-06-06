<?php

namespace App\Interfaces;

use \Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateOrderRequest;

interface OrderControllerInterface
{
    public function create(CreateOrderRequest $request) :JsonResponse;
}