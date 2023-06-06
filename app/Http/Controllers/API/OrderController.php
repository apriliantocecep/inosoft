<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Http\Request;
use App\Interfaces\OrderControllerInterface;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller implements OrderControllerInterface
{
    private $service;

    public function __construct()
    {
        $this->service = new OrderService();
    }

    public function create(CreateOrderRequest $request): JsonResponse
    {
        // DB::beginTransaction();
        try {
            $user = auth('api')->user();

            $order = $this->service->create($request, $user);

            $this->service->notify($order, $user);

            // DB::commit();
            return ResponseHelper::ok($order);
        } catch (\Exception $e) {
            // DB::rollBack();

            return ResponseHelper::error([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
