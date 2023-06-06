<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class KendaraanRepository implements \App\Interfaces\KendaraanRepositoryInterface
{
    public function all()
    {
        return Kendaraan::all();
    }

    public function findById($id) :Kendaraan
    {
        return Kendaraan::findOrFail($id);
    }

    public function create(array $data) :Kendaraan
    {
        return Kendaraan::create($data);
    }

    public function update($id, array $data) :Kendaraan
    {
        $kendaraan = $this->findById($id);
        $kendaraan->update($data);

        return $kendaraan;
    }

    public function delete($id) :void
    {
        Kendaraan::destroy($id);
    }
}
