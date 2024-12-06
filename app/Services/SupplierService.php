<?php

namespace App\Services;

use App\Models\Supplier;

class SupplierService {
    public function getAllSuppliers(){
        return Supplier::all();
    }

    public function getTotalSuppliers(): int
    {
        return Supplier::count();
    }

    public function storeSupplier(array $data){
        return Supplier::create($data);
    }

    public function getSupplier($id){
        return Supplier::find($id);
    }

    public function updateSupplier($id, $data){
        $supplier = Supplier::find($id);
        $supplier->update($data);
        return $supplier;
    }

    public function deleteSupplier($id){
        return Supplier::find($id)->delete();
    }
}