<?php

namespace App\Services;

use App\Models\Unit;
use Illuminate\Support\Facades\Crypt;

class UnitService
{
    public function getAllUnits()
    {
        return Unit::all();
    }

    public function storeUnit($data)
    {
        return Unit::create($data);
    }

    public function updateUnit($id, $data)
    {
        return Unit::find($id)->update([
            "name" => $data
        ]);
    }

    public function deleteUnit($id)
    {
        return Unit::find($id)->delete();
    }
}
