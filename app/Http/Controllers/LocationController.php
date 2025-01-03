<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ],422);
        }
        return response()->json([
            "message" => "berhasil menambah lokasi"
        ],201);
    }
    public function destroy($id)
    {
        $result = $this->locationService->deleteLocation($id);
        if (!$result) {
            return response()->json([
                "message" => "Gagal menghapus lokasi"
            ],404);
        }
        return response()->json([
            "message" => "Berhasil menghapus lokasi"
        ],200);
    }
    public function update(UpdateLocationRequest $request)
    {
        $result = $this->locationService->updateLocation($request->id, $request->all(["name"]));
        if (!$result) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengubah ketegori' . $request->name
            ],404);
        }
        return response()->json([
            "message" => "Berhasil mengubah lokasi"
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getData(Request $request)
    {
        try {

            $totalRecords = DB::table('locations')->count();

            $data = DB::table('locations')->get();
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
