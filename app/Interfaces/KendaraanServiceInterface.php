<?php

namespace App\Interfaces;

use App\Http\Requests\CreateKendaraanRequest;
use App\Http\Requests\UpdateKendaraanRequest;
use App\Http\Resources\KendaraanResource;

interface KendaraanServiceInterface
{
    public function create(CreateKendaraanRequest $request) :KendaraanResource;
    public function update(UpdateKendaraanRequest $request, $id) :KendaraanResource;
    public function delete($id) :void;
    public function read($id) :KendaraanResource;
    public function all() :\Illuminate\Database\Eloquent\Collection|static;
}
