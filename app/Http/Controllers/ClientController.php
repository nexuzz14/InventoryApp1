<?php

namespace App\Http\Controllers;
;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    protected $ClientService;

    public function __construct(ClientService $clientService)
    {
        $this->ClientService = $clientService;
    }

    public function index()
    {
        $data = $this->ClientService->getAllClient();
        return view("dashboard.client", compact("data"));
    }


    public function store(Request $storeClientRequest)
    {
        $result = $this->ClientService->store($storeClientRequest->all());
        if (!$result) {
            return response()->json([
              'message' => 'Gagal menambah client'
            ],422);
        }

        return response()->json([
           'message' => "Berhasil menambah client"
        ],201);
    }

    public function update(Request $request)
    {
        $data = $request->only(["name", "address", "phone"]); // Ambil data yang diizinkan

        $result = $this->ClientService->update($request->id, $data);

        if (!$result) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengubah client ' . $request->name
            ],404);
        }

        return response()->json([
            'message' => 'Berhasil mengubah client'
        ],200);
    }


    public function destroy($id)
    {
        $result = $this->ClientService->delete($id);
        if (!$result) {
            return response()->json([
                'message'=> 'gagal menghapus client'
            ],404);
        }

        return response()->json([
            'message'=> 'berhasil menghapus client'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function getData(Request $request)
    {
        try {

            $totalRecords = DB::table('clients')->count();

            $data = DB::table('clients')->get();
            return response()->json([
                'recordsTotal' => $totalRecords,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => 'Terjadi kesalahan saat mengambil data client',
                'error' => $e->getMessage()
            ]);
        }
    }
}
