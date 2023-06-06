<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Http\Resources\KendaraanResource;
use App\Http\Requests\CreateKendaraanRequest;

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
}
