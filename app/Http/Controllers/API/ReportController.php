<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ReportControllerInterface;
use Illuminate\Http\JsonResponse;
use App\Helper\ResponseHelper;
use App\Models\Kendaraan;
use App\Models\Order;

class ReportController extends Controller implements ReportControllerInterface
{
    public function stock(Request $request): JsonResponse
    {
        $kendaraans = Kendaraan::paginate(10)->withQueryString();
        $kendaraansMap = $kendaraans->getCollection()->map(function ($kendaraan) {
            $data = [];
            $data['id'] = $kendaraan->id;
            $data['nama'] = $kendaraan->nama;
            $data['stok'] = $kendaraan->stok;
            
            return $data;
        })->toArray();

        $itemsTransformedAndPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $kendaraansMap,
            $kendaraans->total(),
            $kendaraans->perPage(),
            $kendaraans->currentPage(), [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return ResponseHelper::ok($itemsTransformedAndPaginated);
    }

    public function order(Request $request): JsonResponse
    {
        $orders = Order::paginate(10)->withQueryString();
        $ordersMap = $orders->getCollection()->map(function ($order) {
            $data = [];
            $data['id'] = $order->id;
            $data['user'] = $order->user ? $order->user->name : "N/A";
            $data['kendaraan'] = $order->kendaraan ? $order->kendaraan->nama : "N/A";
            $data['quantity'] = $order->qty;
            $data['price'] = $order->price;
            $data['status'] = $order->status;
            $data['total'] = $order->qty*$order->price;
            $data['created_at'] = $order->created_at->diffForHumans();
            
            return $data;
        })->toArray();

        $itemsTransformedAndPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $ordersMap,
            $orders->total(),
            $orders->perPage(),
            $orders->currentPage(), [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return ResponseHelper::ok($itemsTransformedAndPaginated);
    }

    public function kendaraan(Request $request, $id): JsonResponse
    {
        $orders = Order::where('kendaraan_id', $id)->paginate(10)->withQueryString();
        $ordersMap = $orders->getCollection()->map(function ($order) {
            $data = [];
            $data['id'] = $order->id;
            $data['user'] = $order->user ? $order->user->name : "N/A";
            $data['kendaraan'] = $order->kendaraan ? $order->kendaraan->nama : "N/A";
            $data['quantity'] = $order->qty;
            $data['price'] = $order->price;
            $data['status'] = $order->status;
            $data['total'] = $order->qty*$order->price;
            $data['created_at'] = $order->created_at->diffForHumans();
            
            return $data;
        })->toArray();

        $itemsTransformedAndPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $ordersMap,
            $orders->total(),
            $orders->perPage(),
            $orders->currentPage(), [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return ResponseHelper::ok($itemsTransformedAndPaginated);
    }
}
