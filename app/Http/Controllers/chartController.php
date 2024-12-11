<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\chart;
use App\Services\RequestItemService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class chartController extends Controller
{
    protected $requsetItemService;
    public function __construct(RequestItemService $requestItemService)
    {
        $this->requsetItemService = $requestItemService;
    }
    public function chart()
    {
        if (Auth::check()) {
            $data = chart::with('item')->where('user_id', Auth::user()->id)->get();
            return view('chart', compact('data'));
        }
    }
    public function update($id, Request $request)
    {
        try {
            $data = $request->validate([
                'quantity' => 'integer|required'
            ]);
            if (Auth::check()) {
                $idOrigin = Crypt::decrypt($id);
                $data = Chart::find($idOrigin);

                if ($data && Auth::user()->id == $data['user_id']) {
                    $newQuantity = $request->input('quantity', 0);
                    $item = $data->item;
                    if ($newQuantity <= $item->quantity) {
                        $data->quantity = $newQuantity;
                        $data->save();

                        return redirect()->back();
                    } else {
                        return redirect()->back()->with("message", "Jumlah melebihi stok tersedia");
                    }
                } else {
                    return redirect()->back()->with("message", "Data tidak valid");
                }
            } else {
                return redirect()->back()->with("message", "Harap login terlebih dahulu");
            }
        } catch (\Exception $e) {
            Log::alert($e);
            return redirect()->back()->with("message", "Terjadi kesalahan: " . $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            if (Auth::check()) {
                $idOrigin = Crypt::decrypt($id);
                $data = chart::find($idOrigin);
                if ($data && Auth::user()->id == $data['user_id']) {
                    $data->delete();
                    return redirect()->back()->with("message", "Barang dihapus Dari daftar");

                } else {
                    return redirect()->back()->with("message", "Barang gagal dihapus Dari daftar");
                }
            }
            Log::debug("ga tau");
        } catch (\Exception $e) {
            return redirect()->back()->with("message", "Barang gagal dihapus Dari daftar");

        }

    }

    public function store(Request $request)
    {
        $requestResult = $this->requsetItemService->storeRequest($request->all());
        if ($requestResult) {
            try {
                Log::alert($request);
                foreach ($request->chartData as $item) {
                    $data = Chart::find($item);
                    if ($data) {
                        $data->delete();
                    }
                }
                return redirect()->back()->with("message", "order berhasil");
            } catch (\Exception $e) {
                return redirect()->back()->with("message", "Order Gagal");
            }
        }
        return redirect()->back()->with("message", "Order Gagal");
    }
}
