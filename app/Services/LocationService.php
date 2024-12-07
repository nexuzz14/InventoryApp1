<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Location;
use Illuminate\Support\Facades\Crypt;

class LocationService
{
    public function store($data)
    {
        $result = Location::create($data);
        return $result;
    }

    public function getAllLocations()
    {
        return Location::all();
    }
    public function updateLocation($id, $data){
        $result = Location::find(Crypt::decrypt($id))->update($data);
        return $result;
    }
    public function getTotalLocation(): int
    {
        return Location::count();
    }

    public function deleteLocation($id)
    {
        $item = Location::find(Crypt::decrypt($id))->delete();
        return $item;
    }
}