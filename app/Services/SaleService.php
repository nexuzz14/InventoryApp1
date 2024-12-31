<?php

namespace App\Services;

use App\Models\sale;
use App\Models\itemSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleService
{
  public function create($data)
  {

    DB::beginTransaction();

    try {
      $sale = Sale::create([
        'code_proyek' => $data['code_proyek'],
        'client_id' => $data['client_id'],
      ]);

      if (isset($data['items']) && is_array($data['items'])) {
        foreach ($data['items'] as $item) {
          $itemSale = new ItemSale([
            'sale_id' => $sale->id,
            'item_id' => $item['item_id'],
            'quantity' => $item['quantity'],
          ]);

          $itemSale->total = $itemSale->calculateTotal();
          $itemSale->save();

          $sale->total = $sale->calculateTotal();
          $sale->save();
        }
      }
      DB::commit();
      return true;
    } catch (\Exception $e) {
      Log::error('Error in Sale creation:', [
        'message' => $e->getMessage(),
        'code' => $e->getCode(),
        'trace' => $e->getTraceAsString(),
    ]);
    DB::rollBack(); // Rollback all changes if any exception occurs
    return false; // Return false or handle as needed
    }
  }


  public function accept($data){
    
  }
}
