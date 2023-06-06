<?php

namespace App\Interfaces;

use \Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateKendaraanRequest;
use App\Http\Requests\UpdateKendaraanRequest;

interface KendaraanControllerInterface
{
    public function create(CreateKendaraanRequest $request) :JsonResponse;
    public function update(UpdateKendaraanRequest $request, $id) :JsonResponse;
    public function delete($id) :JsonResponse;
    public function read($id) :JsonResponse;
    public function all() :JsonResponse;
}