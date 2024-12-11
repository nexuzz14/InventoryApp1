<?php

namespace App\Http\Controllers;

use App\Models\RequestItem;
use App\Services\RequestItemService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $requestItemService;
    public function __construct(TransactionService $transactionService, RequestItemService $requestItemService)
    {
        $this->requestItemService = $requestItemService;
        $this->transactionService = $transactionService;
    }

    public function getAllRequest(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'];
        $totalRecords = DB::table('request_items')->count();

        $query = $this->requestItemService->getAllRequest();
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

    public function updateItemsRequestDetail(Request $request){
        $result = $this->requestItemService->updateItemsRequestDetail($request->id);
        return response()->json($result);
    }

    public function storeTransaction(Request $request){
        $result = $this->transactionService->storeTransaction($request->all());
        return response()->json($result);
    }
}
