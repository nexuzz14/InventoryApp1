<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Location;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class ItemService
{
    public function store($data): bool
    {
        $item = Item::create($data);
        if (!$item) {
            return false;
        }
        return true;
    }

    public function storeLocationStock($request)
    {
        $item = Item::find($request['id']);
        if ($item) {
            $locations = $request['locations'] ?? [];
            if (!empty($locations)) {
                $attachData = $request['location'];
                $item->locations()->attach($attachData);
            }
            return true;
        }
        return false;
    }

    public function getLocalData($itemId)
    {
        $item = Item::with(['locations', 'unit'])
            ->find($itemId);

        if ($item) {
            
            $locations = $item->locations->map(function ($location) {
                return [
                    'id' => $location->pivot->id,
                    'location_id' => $location->pivot->location_id,
                    'quantity' => $location->pivot->quantity
                ];
            });
            return [
                'status' => 'success',
                'data' => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'image' => $item->image,
                    'category_id' => $item->category_id,
                    'quantity' => $item->quantity,
                    'description' => $item->description,
                    'status' => $item->status,
                    'price' => $item->price,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'locations' => $locations,
                    'unit' => $item->unit->name
                ]
            ];
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Item not found'
        ], 404);
    }



    public function updateAll($itemId, $locations)
    {
        $item = Item::find($itemId);
        Log::debug($itemId);
    
        if ($item) {
            $existingLocations = $item->locations()->pluck('item_location.id')->toArray();
            $updatedLocationIds = [];
            foreach ($locations as $location) {
                if (isset($location['id'])) {
                    $item->locations()->updateExistingPivot(
                        $location['id'],  // ID relasi pivot
                        [
                            'location_id' => $location['location_id'],
                            'quantity' => $location['quantity']
                        ]
                    );
                    $updatedLocationIds[] = $location['id']; 
                } 
            }
            $locationsToDetach = array_diff($existingLocations, $updatedLocationIds);
            Log::debug($locationsToDetach);
    
            if (!empty($locationsToDetach)) {
                DB::table('item_location')
                ->whereIn('id', $locationsToDetach)
                ->delete();
            }

            foreach($locations as $location){
                if(!isset($location['id'])) {
                    $item->locations()->attach($location['location_id'], ['quantity' => $location['quantity']]);
                }
            }
           
            return true;
        }
        return false;
    }
    


    public function getAllData()
    {
        $items = Item::with('unit')
            ->select('id', 'name', 'category_id', 'quantity', 'status', 'price')
            ->get();

        $data = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'category_id' => $item->category_id,
                'quantity' => $item->quantity,
                'status' => $item->status,
                'price' => $item->price,
                'unit' => $item->unit->name ?? ''
            ];
        });

        return $data;
    }


    public function updateItemLocation($request, Item $item)
    {
        $item->locations()->sync($request->locations);
        $item->quantity = $item->calculateTotalQuantity();
        $item->save();
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
