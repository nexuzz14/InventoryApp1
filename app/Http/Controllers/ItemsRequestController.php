<?php

namespace App\Http\Controllers;

use App\Models\chart;
use App\Models\Item;
use App\Services\RequestItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
class ItemsRequestController extends Controller
{
  protected $requestService;

  public function __construct(RequestItemService $requestService) {
    $this->requestService = $requestService;
  }

  // fungsi lama
  public function getAllRequest()
  {
      $data = $this->requestService->getAllRequest();
      
      return response()->json([
          "data" => $data
      ], 200);
  }

  public function getDetailRequest($id)
  {
      $data = $this->requestService->getDetailRequest($id);

      if($data){
          return response()->json([
              "data" => $data
          ], 200);
      }
      return response()->json([
          "message"=>"data tidak ditemukan"
      ], 500);
  }


  public function updateItemsRequestDetail(Request $request)
  {
      $data = [
          "quantity_accepted"=> $request->quantity
      ];
      $result = $this->requestService->updateRequestDetail($request->id, $data);

      if($result){
          return response()->json([
              "message"=>"berhasil"
          ]);
      }
      return response()->json([
          "message"=>"gagal"
      ]);
  }

  public function delete($id){
    $result =  $this->requestService->deleteRequest($id);
    if ($result){
        return response()->json([
            "message"=>"Request Berhasil Dihapus"
        ]);
    }

    return response()->json([
        "message"=>"Request gagal dihapus"
    ]);
}

  public function store(Request $request)
  {
    try {
      $data = $request->validate([
        'item_id' => 'string|required',
        'quantity' => 'integer|required',
      ]);
      $itemId = Crypt::decrypt($request->item_id);
      $item = Item::find($itemId);

      if ($item && $data['quantity'] <= $item['quantity']) {
        $chart = new chart();
        $chart->user_id = Auth::user()->id;
        $chart->quantity = $data['quantity'];
        $chart->item_id = $itemId;
        $chart->save();
        return redirect()->back()->with("message", "Berhasil Menambahkan Ke Daftar Anda");

      } else {

        return redirect()->back()->with("message", "Terjadi Kesalahan saat menambahkan item ke daftar");
      }
    } catch (\Exception $e) {
      Log::debug("errornya : \n $e");
      return redirect()->back()->with("message", "Terjadi Kesalahan saat menambahkan item ke daftar, $e");
    }
  }
}
