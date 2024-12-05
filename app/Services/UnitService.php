<?php

namespace App\Services;

use App\Models\Unit;

class UnitService {
    public function getAllUnits(){
        return Unit::all();
    }

    public function storeUnit($data){
        return Unit::create($data);
    }

    public function deleteUnit($id){
        return Unit::find($id)->delete();
    }
}