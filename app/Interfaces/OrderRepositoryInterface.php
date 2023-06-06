<?php

namespace App\Interfaces;

use App\Models\Order;
use App\Models\User;
use App\Models\Kendaraan;

interface OrderRepositoryInterface
{
    public function create(Kendaraan $kendaraan, User $user, int $qty) :Order;
    public function findById($id) :Order;
    public function delete($id) :void;
}