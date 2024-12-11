<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Crypt;

class ItemService
{
    public function store($data): bool
    {
        $result = Item::create($data);
        if (!$result) {
            return false;
        }

        return true;
    }


    public function getAllItems()
    {
        // Mengambil semua item dengan relasi yang diperlukan
        $manualItems = Item::where('source', 'manual')->get();
        $purchasingItems = Item::where('source', 'purchasing')->get();

        // Memetakan data manual
        $manualData = $manualItems->map(function ($Item) {
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

        // Memetakan data purchasing
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

        // Mengembalikan data manual dan purchasing
        return [
            'manualItems' => $manualData,
            'purchasingItems' => $purchasingData,
        ];
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
