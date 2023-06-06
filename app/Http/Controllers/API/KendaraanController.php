<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Helper\ResponseHelper;
use App\Services\KendaraanService;
use App\Interfaces\KendaraanControllerInterface;
use App\Http\Requests\CreateKendaraanRequest;
use App\Http\Requests\UpdateKendaraanRequest;

class KendaraanController extends Controller implements KendaraanControllerInterface
{
    //
    private $service;

    public function __construct()
    {
        $this->service = new KendaraanService();
    }

    public function create(CreateKendaraanRequest $request) :JsonResponse
    {
        // DB::beginTransaction();

        try {
            $kendaraan = $this->service->create($request);

            // DB::commit();
            return ResponseHelper::ok($kendaraan);
        } catch (\Exception $e) {
            // DB::rollBack();

            return ResponseHelper::error([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(UpdateKendaraanRequest $request, $id): JsonResponse
    {
        // DB::beginTransaction();

        try {
            $kendaraan = $this->service->update($request, $id);

            // DB::commit();
            return ResponseHelper::ok($kendaraan);
        } catch (\Exception $e) {
            // DB::rollBack();

            return ResponseHelper::error([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete($id): JsonResponse
    {
        // DB::beginTransaction();

        try {
            $this->service->delete($id);

            // DB::commit();
            return ResponseHelper::ok([
                'message' => 'Selected kendaraan has been deleted',
            ]);
        } catch (\Exception $e) {
            // DB::rollBack();

            return ResponseHelper::error([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function read($id): JsonResponse
    {
        // DB::beginTransaction();

        try {
            $kendaraan = $this->service->read($id);

            // DB::commit();
            return ResponseHelper::ok($kendaraan);
        } catch (\Exception $e) {
            // DB::rollBack();

            return ResponseHelper::error([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function all(): JsonResponse
    {
        try {
            $kendaraans = $this->service->all();

            return ResponseHelper::ok($kendaraans);
        } catch (\Exception $e) {

            return ResponseHelper::error([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
