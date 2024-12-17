<?php

namespace App\Services;

use App\Models\ItemsRequestDetail;
use App\Models\RequestItem;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RequestItemService
{
    public function updateItemsRequestDetail($id){
        $data = ItemsRequestDetail::find($id);
        $data->item->decrement('quantity', $data->quantity);
        $status = $data['status'] == "accepted" ? "rejected" : "accepted";
        $data->update([
            'status' => $status
        ]);
        return $data;
    }
    public function getAllRequest()
    {
        return RequestItem::with([

            'requestDetails' => function ($query) {
                $query->select('quantity', 'id', 'item_id', 'status', 'request_id');
            },
            'requestDetails.item' => function ($query) {
                $query->select('name', 'unit_id', 'price', 'id');
            },
            'requestDetails.item.unit' => function ($query) {
                $query->select('name', 'id');
            }
        ])->where('status', 'pending');
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