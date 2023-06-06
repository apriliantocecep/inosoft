<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class KendaraanRepository implements \App\Interfaces\KendaraanRepositoryInterface
{
    public function all() :\Illuminate\Database\Eloquent\Collection|static
    {
        return Kendaraan::all();
    }

    public function findById($id) :Kendaraan
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            throw new \Exception("Kendaraan not found", 1);
        }

        return $kendaraan;
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
        $this->findById($id);

        Kendaraan::destroy($id);
    }
}
