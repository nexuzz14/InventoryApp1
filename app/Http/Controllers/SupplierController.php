<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $result = $this->supplierService->store($storeSupplierRequest->all());
        if (!$result) {
            return response()->json([
                'message' => 'Gagal menambah supplier'
            ], 422);
        }

        return response()->json([
            'message' => "Berhasil menambah supplier"
        ], 201);
    }

    public function update(UpdateSupplierRequest $request)
    {
        $data = $request->only(["name", "address", "phone"]); // Ambil data yang diizinkan

        $result = $this->supplierService->update($request->id, $data);

        if (!$result) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengubah supplier ' . $request->name
            ], 404);
        }

        return response()->json([
            'message' => 'Berhasil mengubah supplier'
        ], 200);
    }


    public function destroy($id)
    {
        $result = $this->supplierService->delete($id);
        if (!$result) {
            return response()->json([
                'message' => 'gagal menghapus supplier'
            ], 404);
        }

        return response()->json([
            'message' => 'berhasil menghapus supplier'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function getData(Request $request)
    {
        try {

            $totalRecords = DB::table('suppliers')->count();

            $data = DB::table('suppliers')->get();
            return response()->json([
                'recordsTotal' => $totalRecords,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => 'Terjadi kesalahan saat mengambil data supplier',
                'error' => $e->getMessage()
            ]);
        }
    }
}
