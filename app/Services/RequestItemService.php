<?php

namespace App\Services;

use App\Models\ItemsRequestDetail;
use App\Models\RequestItem;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RequestItemService
{

    public function getAllRequest()
    {
        return DB::table('request_items')
            ->select(
                'request_items.id',
                'request_items.code as kode',
                'request_items.created_at as tanggal',
                'users.name as namaStaf',   
                'clients.name as namaClient'  
            )
            ->join('users', 'request_items.staff_id', '=', 'users.id')
            ->join('clients', 'request_items.client_id', '=', 'clients.id')
            ->get();
    }
    public function getDetailRequest($id)
    {
        $id = Crypt::decrypt($id);
        return RequestItem::with(['requestDetails', 'requestDetails.item'])->find($id);
    }


    public function storeRequest($data)
    {
        $staff_id = $data['staff_id'];
        $request_items = RequestItem::create([
            'staff_id' => $staff_id,
            'status' => 'pending',
            'client_id' => $data['client_id'],
        ]);

        $result = DB::table('items_request_details')->insert(
            array_map(
                function ($item) use ($request_items) {
                    return [
                        'request_id' => $request_items->id,
                        'item_id' => $item['item_id'],
                        'quantity' => $item['quantity'],
                    ];
                },
                $data['items']
            )
        );

        return $result;
    }
}