<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Kendaraan;
use App\Models\Order;
use App\Models\User;

class OrderRespository implements OrderRepositoryInterface
{
    public function create(Kendaraan $kendaraan, User $user, int $qty): Order
    {
        $order = Order::create([
            'user_id' => $user->id,
            'kendaraan_id' => $kendaraan->id,
            'qty' => $qty,
            'price' => $kendaraan->harga,
            'status' => 'unpaid',
        ]);

        return $order;
    }

    public function findById($id): Order
    {
        $order = Order::find($id);

        if (!$order) {
            throw new \Exception("Order not found", 1);
        }

        return $order;
    }

    public function delete($id): void
    {
        $this->findById($id);

        Order::destroy($id);
    }

    public function paid($id): Order
    {
        $order = $this->findById($id);

        if ($order->status == 'paid') {
            throw new \Exception("Order has been paid", 1);
        }

        $order->status = 'paid';
        $order->save();

        return $order->fresh();
    }
}
