<?php

namespace App\Interfaces;

use App\Models\Kendaraan;

interface KendaraanRepositoryInterface
{
    public function all() :\Illuminate\Database\Eloquent\Collection|static;
    public function findById($id) :Kendaraan;
    public function create(array $data) :Kendaraan;
    public function update($id, array $data) :Kendaraan;
    public function delete($id) :void;
    public function checkStock($id) :void;
    public function reduceStock($id, int $qty) :void;
}