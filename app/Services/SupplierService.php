<?php

namespace App\Services;

use App\Models\Supplier;
use Illuminate\Support\Facades\Crypt;

class SupplierService
{
    public function getAllSuppliers()
    {
        return Supplier::all();
    }

    public function getTotalSuppliers(): int
    {
        return Supplier::count();
    }

    public function createSupplier(array $data)
    {
        return Supplier::create($data);
    }

    public function getSupplier($id)
    {
        return Supplier::find($id);
    }

    public function updateSupplier($id, $data)
    {
        $supplier = Supplier::find(Crypt::decrypt($id));
        $supplier->update($data);
        return $supplier;
    }

    public function deleteSupplier($id)
    {
        return Supplier::find(Crypt::decrypt($id))->delete();
    }
}