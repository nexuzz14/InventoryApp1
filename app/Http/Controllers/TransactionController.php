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

    public function store(Request $request)
    {
        $data = $request->all();
        $data['staff_id'] = $request->user()->id;

        $requestResult = $this->requestItemService->storeRequest($data);
        return response()->json([
            "message"=> "berhasil"
        ], 200);
      
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

    // public function updateItemsRequestDetail(Request $request)
    // {
    //     $result = $this->requestItemService->updateItemsRequestDetail($request->id);
    //     return response()->json($result);
    // }

    // old function
    public function updateTransaction(Request $request){
        try{
            $data = $request->validate([
                'id'=>"required|integer",
                'nominal'=>"required|integer|min:0",
            ]);

            $result =   $this->transactionService->transactionPay($data['id'], $data['nominal']);
            if($result){
                return response()->json([
                    "message"=>"success",
                ]);
            }
            return response()->json([
                "message"=>"failed",
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message"=>"failed $e",
            ]);
        }
    }
    // old function

    public function storeTransaction(Request $request)
    {
        $result = $this->transactionService->storeTransaction($request->all());
        return response()->json([
            'message'=>"succes",
            "data"=>$result
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
