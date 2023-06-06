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
}
