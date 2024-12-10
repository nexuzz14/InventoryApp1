<?php

namespace App\Http\Controllers;

use App\Models\chart;
use App\Models\Item;
use App\Services\RequestItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
class UnitsRequestController extends Controller
{
  public function create($idBarang)
  {
    if ($idBarang == null) {
      return redirect()->route('page.home');
    }
    ;
    try {
      $id = Crypt::decrypt($idBarang);
      $selectedUnit = Item::where('id', $id)->first();
      if ($selectedUnit) {
        return view('user.request', compact('selectedUnit'));
      } else {
        return redirect()->route('page.home');
      }
    } catch (\Exception $e) {
      return redirect()->route('page.home');
    }

  }

  protected $itemRequestService;

    public function __construct(RequestItemService  $requestService) {
      $this->itemRequestService = $requestService;
    }
    public function create($idBarang){
        if($idBarang == null){
            return redirect()->route('home');
        };
        try{
           $id = Crypt::decrypt($idBarang);
          $selectedUnit = Item::where('id', $id)->with('category', 'unit')->first();
          if($selectedUnit){
            return view('user.request', compact('selectedUnit'));
          }  else{
            return redirect()->route('home');
          }
        } catch(\Exception $e){
            return redirect()->route('home');
        }

    }
  
    public function store(Request $request){
      try{
        $data = $request->validate([
          'item_id'=>'string|required',
          'quantity'=>'integer|required',
        ]);
        $itemId = Crypt::decrypt($request->item_id);
        $item = Item::find($itemId);
     
        if($item && $data['quantity'] <= $item['quantity']){
            $chart = new chart();
            $chart->user_id = Auth::user()->id;
            $chart->quantity = $data['quantity'];
            $chart->item_id = $itemId;
            $chart->save();
            return redirect()->back()->with("message", "Berhasil Menambahkan Ke Daftar Anda");

        }else{
       
          return redirect()->back()->with("message", "Terjadi Kesalahan saat menambahkan item ke daftar");
        }
      }catch(\Exception $e){
        Log::debug("errornya : \n $e");
        return redirect()->back()->with("message", "Terjadi Kesalahan saat menambahkan item ke daftar, $e");
      }
    }
}
