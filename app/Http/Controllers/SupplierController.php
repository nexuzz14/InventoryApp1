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


    public function store(Request $storeSupplierRequest)
    {
        $result = $this->supplierService->store($storeSupplierRequest->all());
        if (!$result) {
            return response()->json([
              'message' => 'Gagal menambah supplier'
            ]);
        }

        return response()->json([
           'message' => "Berhasil menambah supplier"
        ]);
    }

    public function update(Request $request)
    {
        $result = $this->supplierService->update($request->id, $request->all(["name", "address", "phone"]));
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
        $result = $this->supplierService->delete($id);
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
