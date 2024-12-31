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

      return response()->json($data, 200);
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
          "message"=>"Data tidak ditemukan"
      ], 404);
  }


  public function updateItemsRequestDetail(Request $request)
  {
      $data = [
          "quantity_accepted"=> $request->quantity
      ];
      $result = $this->requestService->updateRequestDetail($request->id, $data);

      if($result){
          return response()->json([
              "message"=>"Berhasil update item"
          ],200);
      }
      return response()->json([
          "message"=>"Gagal update item"
      ], 404);
  }

  public function delete($id){
    $result =  $this->requestService->deleteRequest($id);
    if ($result){
        return response()->json([
            "message"=>"Request Berhasil Dihapus"
        ],200);
    }

    return response()->json([
        "message"=>"Request gagal dihapus"
    ],404);
}

 
}
