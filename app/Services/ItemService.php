<?php

namespace App\Services;

use App\Models\Item;

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
        $Item = Item::all();

        $data = $Item->map(function ($Item) {
            return [
                'id' => $Item->id,
                'name' => $Item->nama,
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

        return $data;
    }

    public function getItemsByCategoryId($categoryId)
    {
        return Item::where('category_id', $categoryId)->get();
    }
}