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
        $staff_id = Crypt::decrypt($data['staff_id']);
        $request_items = RequestItem::create([
            'staff_id' => $staff_id,
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

        return $result;
    }
}