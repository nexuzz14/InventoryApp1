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


    public function create(StoreSupplierRequest $storeSupplierRequest)
    {
        $result = $this->supplierService->createSupplier($storeSupplierRequest->all());
        if (!$result) {
            return back()->withErrors([
                "Terjadi kesalahan saat membuat supplier"
            ]);
        }

        return back()->withSuccess([
            "Supplier berhasil ditambahkan"
        ]);
    }

    public function update(UpdateSupplierRequest $request)
    {
        $result = $this->supplierService->updateSupplier($request->id, $request->all(["name", "address", "phone"]));
        if (!$result) {
            return back()->withErrors([
                "Terjadi kesalahan saat memperbarui supplier"
            ]);
        }

        return back()->withSuccess([
            "Supplier berhasil diperbarui"
        ]);
    }

    public function destroy($id)
    {
        $result = $this->supplierService->deleteSupplier($id);
        if (!$result) {
            return back()->withErrors([
                "Terjadi kesalahan saat menghapus supplier"
            ]);
        }

        return back()->withSuccess([
            "Supplier berhasil dihapus"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
