<?php

namespace App\Interfaces;

use App\Http\Requests\CreateKendaraanRequest;
use App\Http\Resources\KendaraanResource;

interface KendaraanServiceInterface
{
    public function create(CreateKendaraanRequest $request) :KendaraanResource;
}
