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
            // Buat entri untuk Sale
            $sale = Sale::create([
                'code_proyek' => $data['code_proyek'],
                'client_id' => $data['client_id'],
            ]);

            // Iterasi melalui items
            if (isset($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $item) {
                    if (isset($item['location']) && is_array($item['location'])) {
                        foreach ($item['location'] as $location) {
                            // Ambil harga dari database
                            $itemData = \App\Models\Item::find($item['item_id']);
                            if (!$itemData) {
                                throw new \Exception("Item dengan ID {$item['item_id']} tidak ditemukan.");
                            }

                            $total = $location['quantity'] * $itemData->price; // Hitung total berdasarkan harga item

                            // Tambahkan item ke ItemSale
                            ItemSale::create([
                                'sale_id' => $sale->id,
                                'item_id' => $item['item_id'],
                                'quantity' => $location['quantity'],
                                'total' => $total,
                            ]);
                        }
                    }
                }
            }

            // Hitung dan simpan total untuk Sale
            $sale->total = $sale->calculateTotal();
            $sale->save();

            DB::commit();
            return $sale;
        } catch (\Exception $e) {
            Log::error('Error in Sale creation:', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);

            DB::rollBack();
            return false;
        }
    }



  public function accept($data){

  }
}
