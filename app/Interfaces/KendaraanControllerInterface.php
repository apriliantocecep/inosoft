<?php

namespace App\Interfaces;

use \Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateKendaraanRequest;

interface KendaraanControllerInterface
{
    public function create(CreateKendaraanRequest $request) :JsonResponse;
}