<?php

namespace App\Interfaces;

use App\Http\Resources\OrderResource;
use App\Models\User;
use App\Models\Order;
use App\Http\Requests\CreateOrderRequest;

interface OrderServiceInterface
{
    public function create(CreateOrderRequest $request, User $user) :OrderResource;
    public function notify(OrderResource $order, User $user);
    public function paid($id, User $user) :OrderResource;
}