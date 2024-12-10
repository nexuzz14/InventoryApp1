<?php

namespace App\Services;

use App\Models\RequestItem;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RequestItemService
{
    public function getDetailRequest($id)
    {
        $id = Crypt::decrypt($id);
        return RequestItem::with(['requestDetails', 'requestDetails.item'])->find($id);
    }

    public function storeRequest($data)
    {
        $request_items = RequestItem::create([
            'customer_id' => $data['customer_id'],
            'status' => 'pending',
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

        return $request_items;
    }
}