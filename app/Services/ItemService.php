<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ItemService
{
    public function store($data): bool
    {
        $suppliers = $data['suppliers'] ?? [];
        $locations = $data['locations'] ?? [];
        $totalQuantity = 0;
        if (!empty($locations)) {
            $totalQuantity = array_sum(array_map(function ($location) {
                return $location['quantity'] ?? 0;
            }, $locations));

            $data['quantity'] = $totalQuantity;
        }
        unset($data['suppliers'], $data['locations']);

        $item = Item::create($data);

        if (!$item) {
            return false;
        }
        if (!empty($suppliers)) {
            $item->suppliers()->attach($suppliers);
        }
        if (!empty($locations)) {
            $item->locations()->attach($locations);
        }

        return true;
    }

    public function calculateQty($id)
{
    $data = [];
    $locations = DB::table('item_location')->where('item_location.item_id', $id)->get();

    if (!$locations->isEmpty()) { // Periksa jika koleksi tidak kosong
        $totalQuantity = $locations->sum('quantity'); // Menjumlahkan semua kuantitas
        
        $data['quantity'] = $totalQuantity;
        $data['status'] = $totalQuantity <= 0 ? "tidak tersedia" : "tersedia";
    } else {
        // Jika tidak ada lokasi, anggap stok tidak tersedia
        $data['quantity'] = 0;
        $data['status'] = "tidak tersedia";
    }

    Item::find($id)->update($data); // Update data item
    return true;
}

    public function getAllItems()
    {
        $manualItems = Item::where('source', 'manual')->get();
        $purchasingItems = Item::where('source', 'purchasing')->get();
        $manualData = $manualItems->map(function ($Item) {
            return [
                'id' => $Item->id,
                'name' => $Item->name,
                'category' => $Item->category->name,
                'supplier' => $Item->supplier->name,
                'unit' => $Item->unit->name,
                'location' => $Item->location,
                'image' => $Item->image,
                'quantity' => $Item->quantity,
                'price' => $Item->price,
                'status' => $Item->status,
            ];
        });
        $purchasingData = $purchasingItems->map(function ($Item) {
            return [
                'id' => $Item->id,
                'name' => $Item->name,
                'category' => $Item->category->name,
                'supplier' => $Item->supplier->name,
                'unit' => $Item->unit->name,
                'location' => $Item->location->name,
                'image' => $Item->image,
                'quantity' => $Item->quantity,
                'price' => $Item->price,
                'status' => $Item->status,
            ];
        });
        return [
            'manualItems' => $manualData,
            'purchasingItems' => $purchasingData,
        ];
    }
    public function updateItemLocation($request, Item $item)
    {
        $item->locations()->sync($request->locations);
        $item->quantity = $item->calculateTotalQuantity();
        $item->save();
    }

    public function updateStock($data)
    {
        foreach ($data as $itemData) {
            // Cari item berdasarkan ID
            $item = Item::find($itemData['id']);

            if ($item) {
                // Loop ke lokasi-lokasi yang terkait dan update quantity-nya
                foreach ($itemData['locations'] as $locationData) {
                    // Update quantity pada pivot table item_location
                    $item->locations()->updateExistingPivot(
                        $locationData['location_id'],
                        ['quantity' => $locationData['quantity']] // Hanya update quantity
                    );
                }
            } else {
                return response()->json([
                    "message"=>"gagal memperbarui",
                ]);
            }
        }
    }

    public function getTotalItems(): int
    {
        return Item::count();
    }
    public function getItemsByCategoryId($categoryId)
    {
        return Item::where('category_id', $categoryId)->get();
    }

    public function deleteItem($id)
    {
        $item = Item::find(Crypt::decrypt($id))->delete();
        if (!$item) {
            return false;
        }
        return true;
    }

    public function updateItem($id, $data)
    {
        $item = Item::find(Crypt::decrypt($id))->update($data);
        if (!$item) {
            return false;
        }
        return true;
    }
}
