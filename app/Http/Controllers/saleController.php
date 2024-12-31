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
    public function new(){

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
        ]);

    }
}
