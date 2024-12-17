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

    public function store(array $data)
    {
        return Supplier::create($data);
    }

    public function getSupplier($id)
    {
        return Supplier::find($id);
    }

    public function update($id, $data)
    {
        $supplier = Supplier::find($id);
        $supplier->update($data);
        return $supplier;
    }

    public function delete($id)
    {
        return Supplier::find($id)->delete();
    }
}
