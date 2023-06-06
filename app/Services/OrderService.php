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
use App\Notifications\PaidOrderNotification;

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

        $resource = new OrderResource($order);

        // check the stock
        try {
            $this->kendaraanRepository->checkStock($request->kendaraan_id);
        } catch (\Exception $e) {
            // remove order
            $this->repository->delete($order->id);
            throw new \Exception($e->getMessage(), 1);
        }

        return $resource;
    }

    public function notify(OrderResource $order, User $user)
    {
        $user->notify(new OrderCreatedNotification($order));
    }

    public function paid($id, User $user): OrderResource
    {
        $order = $this->repository->paid($id);

        $resource = new OrderResource($order);

        // reduce the stock
        try {
            $this->kendaraanRepository->reduceStock($resource->kendaraan_id, $resource->qty);
        } catch (\Exception $e) {
            // remove order
            $this->repository->delete($order->id);
            throw new \Exception($e->getMessage(), 1);
        }

        // notify
        $user->notify(new PaidOrderNotification($resource));

        return $resource;
    }
}
