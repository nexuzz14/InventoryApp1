<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SaleService;
use Illuminate\Http\Request;

class saleController extends Controller
{
    protected $saleService;
    public function __construct(SaleService $saleService) {
        $this->saleService = $saleService;
    }
        public function accepted(Request $request){
            $data = $request->all();
            $result = $this->saleService->accept($data);
            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Sale accepted and status updated to "bayar".'
                ], 200); 
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'There was an error during the accept process.'
                ], 400); 
            }
        }

    public function create(Request $request){
        $data = $request->all();
        if($request->user()->role == 'admin' || $request->user()->role == 'superadmin'){
            $data['client_id'] = $request['client_id'];
        }else{
            $data['client_id'] = $request->user()->id;
        }

        $result = $this->saleService->create($data);

        if($result){
            return response()->json([
                "message"=>"berhasil membuat request",
            "error"=>$result

            ]);
        }
        return response()->json([
            "message"=>"gagal membuat request",
            "error"=>$result
        ],200);

    }
}
