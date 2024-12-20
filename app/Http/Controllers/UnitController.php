<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Unit;
use App\Services\UnitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    protected $unitService;
    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }
    public function index()
    {
        $data = $this->unitService->getAllUnits();
        return view("dashboard.satuan", compact("data"));
    }

    public function store(StoreUnitRequest $request)
    {
        $result = $this->unitService->storeUnit($request->all());
        if (!$result) {
            return response()->json([
                'message'=>'Gagal menambah satuan',
            ],422);
        }
        return response()->json([
            'message' => 'berhasil menambah satuan'
        ],201);
    }

    public function destroy(Request $request)
    {
        $result = $this->unitService->deleteUnit($request->id);
        if (!$result) {
            return response()->json([
                'message' => 'gagal menghapus satuan'
            ],404);
        }
        return response()->json([
            'message' => 'berhasil menghapus satuan'
        ],200);
    }

    public function update(Request $request)
    {
        $result = $this->unitService->updateUnit($request->id, $request->name);
        if (!$result) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengubah satuan' . $request->name
            ],404);
        }
        return response()->json([
            'message' => 'berhasil mengubah satuan'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function getData(Request $request)
    {
        try {

            $totalRecords = DB::table('units')->count();

            $data = DB::table('units')->get();
            return response()->json([
                'recordsTotal' => $totalRecords,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => 'Terjadi kesalahan saat mengambil data satuan',
                'error' => $e->getMessage()
            ]);
        }
    }

}
