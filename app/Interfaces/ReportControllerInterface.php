<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

interface ReportControllerInterface
{
    public function stock(Request $request) :JsonResponse;
    public function order(Request $request) :JsonResponse;
    public function kendaraan(Request $request, $id) :JsonResponse;
}