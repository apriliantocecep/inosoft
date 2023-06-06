<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Http\Resources\KendaraanResource;
use App\Http\Requests\CreateKendaraanRequest;
use App\Http\Requests\UpdateKendaraanRequest;

class KendaraanService implements \App\Interfaces\KendaraanServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = new KendaraanRepository();
    }

    public function create(CreateKendaraanRequest $request) :KendaraanResource
    {
        $kendaraan = $this->repository->create($request->toArray());

        $resource = new KendaraanResource($kendaraan);

        return $resource;
    }

    public function update(UpdateKendaraanRequest $request, $id): KendaraanResource
    {
        $kendaraan = $this->repository->update($id, $request->toArray());

        $resource = new KendaraanResource($kendaraan);

        return $resource;
    }

    public function delete($id): void
    {
        $this->repository->delete($id);
    }

    public function read($id): KendaraanResource
    {
        $kendaraan = $this->repository->findById($id);

        $resource = new KendaraanResource($kendaraan);

        return $resource;
    }

    public function all() :\Illuminate\Database\Eloquent\Collection|static
    {
        $kendaraans = $this->repository->all();
        $kendaraans->transform(function($kendaraan) {
            return new KendaraanResource($kendaraan);
        });

        return $kendaraans;
    }
}
