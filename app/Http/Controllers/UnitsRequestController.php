<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
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
}
