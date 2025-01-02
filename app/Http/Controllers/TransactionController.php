<?php

namespace App\Http\Controllers;

use App\Models\RequestItem;
use App\Services\RequestItemService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $requestItemService;
    public function __construct(TransactionService $transactionService, RequestItemService $requestItemService)
    {
        $this->requestItemService = $requestItemService;
        $this->transactionService = $transactionService;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['staff_id'] = $request->user()->id;

        $requestResult = $this->requestItemService->storeRequest($data);
        return response()->json([
            "message" => "berhasil"
        ], 200);
    }
    public function getAllTransactions()
    {
        $data = $this->transactionService->getAllTransaction();
        return response()->json(
            $data,
            200,
            [
                "Content-Type" => "application/json"
            ],

        );
    }

    public function getDetailTransactions($id)
    {
        $data = $this->transactionService->getDetailTransaction($id);
        return response()->json([
            "data" => $data
        ], 200);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['staff_id'] = $request->user()->id;
        $result =   $this->transactionService->new($data);
        if ($result['code'] == 500) {
            return response()->json([
                "message" => $result
            ], 500);
        } else if ($result["code"] == 201) {
            return response()->json([
                "message" => $result
            ], 201);
        }
    }
    // old function
    public function pay($id)
    {
        $result =  $this->transactionService->pay($id);
        if ($result) {
            return response()->json([
                "message" => "berhasil mengubah data"
            ], 200);
        };
        return response()->json([
            "message" => "data tidak ditemukan"
        ], 500);
    }
    // old function

    public function storeTransaction(Request $request)
    {
        Log::debug($request);
        $result = $this->transactionService->storeTransaction($request->all());
        if ($result == null) {
            $result = "tidak ada transaksi";
        }
        return response()->json([
            'message' =>  $result,
        ]);
    }

    public function getAllInvoice(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'];
        $totalRecords = DB::table('request_items')->count();

        $query = $this->transactionService->getAllTransaction();
        // return response()->json($query->get());
        if (!empty($search)) {
            $query->where('nama_pemohon', 'like', "%{$search}%");
        }
        $filteredRecords = $query->count();
        $data = $query->offset($start)->limit($length)->get();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }
}
