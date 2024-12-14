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
                "message"=>"Gagal menambah satuan",
            ]);
        }
        return response()->json([
            'message' => 'berhasil menambah satuan'
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->unitService->deleteUnit($request->id);
        if (!$result) {
            return response()->json([
                'message' => 'gagal menghapus unit'
            ]);
        }
        return response()->json([
            'message' => 'berhasil menghapus kategori'
        ]);
    }

    public function update(UpdateUnitRequest $request)
    {
        $result = $this->unitService->updateUnit($request->id, $request->name);
        if (!$result) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengubah ketegori' . $request->name
            ]);
        }
        return response()->json([
            'message' => 'berhasil mengubah kategori'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

}
