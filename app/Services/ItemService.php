<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use function Psy\debug;

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
        $item = Item::with(['locations', 'unit', 'category'])
            ->find($itemId);

        if ($item) {
            $locations = $item->locations->map(function ($location) {
                return [
                    'id' => $location->pivot->id,
                    'location_id' => $location->pivot->location_id,
                    'name' =>$location->name,
                    'quantity' => $location->pivot->quantity
                ];
            });
            return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'category_id' => $item->category_id,
                    'category_name' => $item->category->name,
                    'quantity' => $item->quantity,
                    'stok_gudang' => $item->quantity_gudang,
                    'description' => $item->description,
                    'price' => $item->price,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'locations' => $locations,
                    'unit_name' => $item->unit->name,
                    'unit_id' => $item->unit->id
            ];
        }
        return response()->json([
            'message' => 'Item not found'
        ], 404);
    }


    public function update($data){
        if(isset($data['locations'])){
        $dataUpdate = Arr::except($data, ['locations']);
        }else{
            $dataUpdate = $data;
        }
        $item = Item::find($data['id']);
        if($item){
            $item->update($dataUpdate);
            if(isset($data['locations'])){
                $this->updateLocation($data['id'], $data['locations']);
            }
        return true;

        }
        return false;
    }
    public function updateLocation($itemId, $locations)
    {
        $item = Item::with('locations')->find($itemId);
        if ($item) {
            $existingLocations = $item->locations()->pluck('location_id')->toArray();
            $totalQuantity = collect($locations)->sum('quantity');
            ;

            $updatedLocationIds = [];
            Log::debug("nod:".$totalQuantity);
            if($totalQuantity <= $item->quantity){
                foreach ($locations as $location) {
                    if (isset($location["location_id"])) {
                        if (in_array($location['location_id'], $existingLocations) && !in_array($location['location_id'], $updatedLocationIds)) {
                            $item->locations()->updateExistingPivot(
                                $location['location_id'],  // ID relasi pivot
                                [
                                    'location_id' => $location['location_id'],
                                    'quantity' => $location['quantity']
                                ]
                            );
                            $updatedLocationIds[] = $location['location_id'];
                        } else {

                            if (in_array($location['location_id'], $updatedLocationIds)) {
                                if (isset($location['location_id'])) {
                                    $currentQuantity = $item->locations()
                                        ->wherePivot('location_id', $location['location_id'])
                                        ->first()
                                        ->pivot
                                        ->quantity ?? 0; // Default ke 0 jika tidak ada nilai

                                    $newQuantity = $currentQuantity + $location['quantity'];
                                    Log::debug("nilai :" . $currentQuantity);
                                    // Update pivot dengan quantity yang sudah ditambahkan
                                    $item->locations()->updateExistingPivot(
                                        $location['location_id'], // ID relasi pivot
                                        ['quantity' => $newQuantity] // Nilai quantity yang baru
                                    );
                                    $updatedLocationIds[] = $location['location_id'];
                                }
                            } else {
                                $item->locations()->attach($location['location_id'], [
                                    "quantity" => $location['quantity']
                                ]);
                                $updatedLocationIds[] = $location['location_id'];
                            }
                        }
                    }
                }
            }else{
                return "gagal, stock melebihi quantity";
            }


            $locationsToDetach = array_diff($existingLocations, $updatedLocationIds);
            if (!empty($locationsToDetach)) {
                $item->locations()->detach($locationsToDetach);
            }
            return "berhasil, data diubah";
        }
        return "gagal, terjadi kesalahan";
    }



    public function getAllData()
    {
        $items = Item::with('unit', 'Category')
            ->select('id','uniq_id', 'name', 'category_id', 'quantity', 'price', 'unit_id', 'description')
            ->get();

        $data = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'uniq_id' => $item->uniq_id,
                'category_id' => $item->category_id,
                'category_name' => $item->category->name ?? 'Unknown',
                'quantity' => $item->quantity,
                'price' => $item->price,
                'unit' => $item->unit->name ?? '',
                'description' => $item->description,
                'unit_id' => $item->unit_id
            ];
        });

        return $data;
    }


    // public function updateItemLocation($request, Item $item)
    // {
    //     $item->locations()->sync($request->locations);
    //     $item->quantity = $item->calculateTotalQuantity();
    //     $item->save();
    // }



    public function getTotalItems(): int
    {
        return Item::count();
    }
    public function getItemsByCategoryId($categoryId)
    {
        return Item::where('category_id', $categoryId)->get();
    }

    public function delete($id)
    {
        return Item::find($id)->delete();
    }

}
