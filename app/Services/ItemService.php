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
        $Item = Item::all();

        $data = $Item->map(function ($Item) {
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

        return $data;
    }

    public function getTotalItems(): int
    {
        return Item::count();
    }
    public function getItemsByCategoryId($categoryId)
    {
        return Item::where('category_id', $categoryId)->get();
    }

    public function deleteItem($id){
        $item = Item::find(Crypt::decrypt($id))->delete();
        if (!$item) {
            return false;
        }
        return true;
    }
}