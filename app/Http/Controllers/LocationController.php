<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $locationService;
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }
    public function index()
    {
        $data = $this->locationService->getAllLocations();
        return view("dashboard.lokasi", compact("data"));
    }
    public function store(StoreLocationRequest $request)
    {
        $result = $this->locationService->store($request->all());
        if (!$result) {
            return response()->json([
                "message" => "gagal menambah lokasi"
            ]);
        }
        return response()->json([
            "message" => "berhasil menambah lokasi"
        ]);
    }
    public function destroy($id)
    {
        $result = $this->locationService->deleteLocation($id);
        if (!$result) {
            return response()->json([
                "message" => "Gagal menghapus lokasi"
            ]);
        }
        return response()->json([
            "message" => "Berhasil menghapus lokasi"
        ]);
    }
    public function update(UpdateLocationRequest $request)
    {
        $result = $this->locationService->updateLocation($request->id, $request->all(["name"]));
        if (!$result) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengubah ketegori' . $request->name
            ]);
        }
        return response()->json([
            "message" => "Berhasil mengubah lokasi"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

}
