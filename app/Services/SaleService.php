<?php

namespace App\Services;

use App\Models\Item;
use App\Models\sale;
use App\Models\itemSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ItemSalesLocation;
use Carbon\Carbon;



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
                        'quantity' => $item['jumlah_non_gudang'],
                    ]);

                    $itemSale->total = $itemSale->calculateTotal();
                    $itemSale->save();

                    // Menghitung pembagian lokasi untuk item yang sama
                    if (isset($item['gudang']) && is_array($item['gudang'])) {
                        foreach ($item['gudang'] as $location) {
                            $itemSaleLocation = new ItemSalesLocation([
                                'item_sales_id' => $itemSale->id,
                                'location_id' => $location['id'],
                                'quantity' => $location['quantity'],
                            ]);
                            $itemSaleLocation->save();
                        }
                    }

                    // Update total penjualan
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
            DB::rollBack();
            return false;
        }
    }

    public function getItemLocations($itemId)
    {
        try {
            $item = Item::where('id', $itemId)->with(['locations'])->first();

            if (!$item) {
                throw new \Exception('Item not found');
            }

            // Ambil data lokasi (gudang) dan stoknya
            $locations = $item->locations->map(function ($location) {
                return [
                    'id' => $location->pivot->id,
                    'location_id' => $location->pivot->location_id,
                    'name' => $location->name, // Asumsi ada atribut 'name' di tabel lokasi
                    'quantity' => $location->pivot->quantity,
                ];
            });

            return $locations;
        } catch (\Exception $e) {
            Log::error('Error retrieving warehouse data:', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);
            response()->json([
                'message' => 'Error retrieving warehouse data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function accept($data)
    {
        DB::beginTransaction();

        try {
            $sale = Sale::find($data['id']);
            if (!$sale) {
                throw new \Exception('Sale not found');
            }
            foreach ($data['items'] as $itemData) {
                $itemSale = $sale->items()->where('item_id', $itemData['item_id'])->first();

                if ($itemSale) {
                    $item = $itemSale->item;

                    foreach ($itemData['gudang'] as $locationData) {
                        $locationItem = $item->locations()->where('location_id', $locationData['id'])->first();

                        if ($locationItem && $locationItem->pivot->quantity >= $locationData['quantity']) {
                            $locationItem->pivot->quantity -= $locationData['quantity'];
                            $locationItem->pivot->save();
                        } else {
                            throw new \Exception('Insufficient quantity in warehouse for location ID ' . $locationData['id']);
                        }
                    }

                    if ($item->quantity >= $itemData['jumlah_non_gudang']) {
                        $item->quantity -= $itemData['jumlah_non_gudang'];
                        $item->save();
                    } else {
                        throw new \Exception('Insufficient quantity in item for item ID ' . $itemData['item_id']);
                    }

                    $itemSale->quantity -= $itemData['jumlah_non_gudang'];
                    $itemSale->total = $itemSale->calculateTotal();
                    $itemSale->save();
                } else {
                    throw new \Exception('ItemSale not found for item ID ' . $itemData['item_id']);
                }
            }

            $sale->total = $sale->calculateTotal();
            $sale->status = 'dibayar';

            $sale->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::error('Error during accept process:', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);
            DB::rollBack(); // Rollback all changes if any exception occurs
            return false;
        }
    }

    public function getAllSales($saleId = null)
    {
        try {
            if ($saleId) {
                $sale = Sale::with(['items', 'items.locations'])->find($saleId);

                if (!$sale) {
                    throw new \Exception('Sale not found');
                }

                $sales = collect([$sale]); // Bungkus dalam collection
            } else {
                $sales = Sale::with(['items', 'items.locations'])->get();
            }

        return $sales->map(function ($sale) {
            return [
                'id' => $sale->id,
                'code_invoice' => $sale->code_invoice,
                'code_proyek' => $sale->code_proyek,
                'client_id' => $sale->client_id,
                'client_name' => $sale->client->name,
                'total' => $sale->total,
                'status' => $sale->status,
                'created_at' => $sale->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $sale->updated_at->format('Y-m-d H:i:s'),
                'items' => $sale->items->map(function ($item) {
                    return [
                        'item_id' => $item->item_id,
                        'quantity' => $item->pivot->quantity,
                        'total' => $item->pivot->total,
                        'locations' => $item->locations->map(function ($location) {
                            return [
                                'location_id' => $location->pivot->location_id,
                                'quantity' => $location->pivot->quantity,
                            ];
                        }),
                    ];
                }),
            ];
        });
    } catch (\Exception $e) {
        Log::error('Error retrieving sales data:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

            throw $e;
        }
    }
    public function getDetail($id)
    {
        try {
            $sale = Sale::with(['client', 'itemSale.item.unit'])->find($id);
            Log::debug($sale);

            if ($sale) {
                $client = $sale->client ? $sale->client->name : "client dihapus";
                $dp = $sale->date_payment ? $sale->date_payment : "belum dibayar";
                $items = $sale->itemSale->map(function ($itemSale) {
                    return [
                        "name" => $itemSale->item->name ?? "Item tidak ditemukan",
                        "quantity" => $itemSale->quantity,
                        "unit_name" => $itemSale->item->unit->name ?? "Unit Dihapus",
                        "price" => $itemSale->item->price,
                        "total" => $itemSale->total,
                    ];
                });

            return [

                    "code_invoice" => $sale->code_invoice,
                    "code_proyek" => $sale->code_proyek,
                    "client" => $client,
                    "total" => $sale->total,
                    "status" => $sale->status,
                    "created_at" => $sale->created_at->format("Y-m-d"),
                    "date_payment" => $dp,
                    "items" => $items,

            ];
        } else {
            return [
                "status" => "error",
                "message" => "Data tidak ditemukan",
            ];
        }
    } catch (\Exception $e) {
        return [
            "status" => "error",
            "message" => "Terjadi kesalahan: " . $e->getMessage(),
        ];
    }
}

    public function update($id,$updateData){
        try{
            $data = sale::find($id);
            if($data){
                $data->update($updateData);
                return "berhasil diperbarui";
            }
            return "data tidak ditemukan";
        }catch(\Exception $e){
            return [
                "message" => "Terjadi kesalahan: " . $e->getMessage(),
            ];
        }
    }
}


