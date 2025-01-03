<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SaleService;
use Illuminate\Http\Request;

use function Illuminate\Log\log;



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
        ],500);

    }

    public function getAllSales()
    {
        try {
            $result = $this->saleService->getAllSales();

            return response()->json([
                "status" => "success",
                "message" => "Sales data retrieved successfully",
                "data" => $result,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function getDetail($id){
        $result =  $this->saleService->getDetail($id);
        return $result;
    }

    public function getItemLocations($itemId)
    {
        try {
            // Gunakan SaleService untuk mendapatkan data gudang
            $result = $this->saleService->getItemLocations($itemId);

                return response()->json([
                "status" => "success",
                "data" => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function updatePayDate(Request $request){
        $date = $request->date;
        $id = $request->id;
        $data = [
            "status"=>"dibayar",
            "date_payment"=>$date
        ];

        $result =   $this->saleService->update($id, $data);
        return response()->json([
            "message"=>$result
        ]);
    }
}
