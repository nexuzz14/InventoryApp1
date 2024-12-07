<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Unit;
use App\Services\UnitService;
use Illuminate\Http\Request;

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
            return back()->withErrors([
                'message' => 'Data gagal disimpan'
            ]);
        }
        return back()->withSuccess([
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function destroy($id)
    {
        $result = $this->unitService->deleteUnit($id);
        if (!$result) {
            return back()->withErrors([
                'message' => 'Data gagal dihapus'
            ]);
        }
        return back()->withSuccess([
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function update(UpdateUnitRequest $request)
    {
        $result = $this->unitService->updateUnit($request->id, $request->name);
        if (!$result) {
            return back()->withErrors([
                'message' => 'Data gagal diperbarui'
            ]);
        }
        return back()->withSuccess([
            'message' => 'Data berhasil diperbarui'
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
