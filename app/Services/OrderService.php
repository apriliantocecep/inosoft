<?php

namespace App\Services;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderServiceInterface;
use App\Models\Order;
use App\Repositories\OrderRespository;
use App\Repositories\KendaraanRepository;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;

class OrderService implements OrderServiceInterface
{
    private $repository;
    private $kendaraanRepository;

    public function __construct()
    {
        $this->repository = new OrderRespository(); 
        $this->kendaraanRepository = new KendaraanRepository(); 
    }

    public function create(CreateOrderRequest $request, User $user): OrderResource
    {
        $kendaraan = $this->kendaraanRepository->findById($request->kendaraan_id);

        $order = $this->repository->create($kendaraan, $user, $request->qty);

        // reduce the stock
        try {
            $this->kendaraanRepository->reduceStock($request->kendaraan_id, $request->qty);
        } catch (\Exception $e) {
            // remove order
            // due the database transaction not working
            $this->repository->delete($order->id);
            throw new \Exception($e->getMessage(), 1);
        }

        $resource = new OrderResource($order);

        return $resource;
    }

    public function notify(OrderResource $order, User $user)
    {
        $user->notify(new OrderCreatedNotification($order));
    }
}
