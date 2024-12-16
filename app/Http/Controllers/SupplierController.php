<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $data = $this->supplierService->getAllSuppliers();
        return view("dashboard.supplier", compact("data"));
    }


    public function store(StoreSupplierRequest $storeSupplierRequest)
    {
        $result = $this->supplierService->storeSupplier($storeSupplierRequest->all());
        if (!$result) {
            return response()->json([
              'message' => 'Gagal menambah supplier'
            ]);
        }

        return response()->json([
           'message' => "Berhasil menambah supplier"
        ]);
    }

    public function update(UpdateSupplierRequest $request)
    {
        $result = $this->supplierService->updateSupplier($request->id, $request->all(["name", "address", "phone"]));
        if (!$result) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengubah supplier' . $request->name
            ]);
        }

        return response()->json([
            'message' => 'berhasil mengubah supplier'
        ]);
    }

    public function destroy($id)
    {
        $result = $this->supplierService->deleteSupplier($id);
        if (!$result) {
            return response()->json([
                'message'=> 'gagal menghapus supplier'
            ]);
        }

        return response()->json([
            'message'=> 'berhasil menghapus supplier'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }
}
