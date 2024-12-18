<?php

namespace App\Services;

use App\Models\Item;
use App\Models\RequestItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\ItemService;
class TransactionService
{
    protected $itemService;
    public function __construct(ItemService $ItemService) {
        $this->itemService = $ItemService;
    }
    public function storeTransaction($data)
    {
        $buyPrice = 0;
        $totalQty = 0;

        $request_tabel = RequestItem::with('requestDetails.item.locations')->find($data['request_id']);
        $requestDetails = $request_tabel->requestDetails;
        foreach ($data['data'] as $itemsSelected) {

            $item = $requestDetails->find($itemsSelected['details_id']); 
            $item->quantity = $itemsSelected['quantity'];
            $item->save();
            if ($item && $item->quantity > 0) {
                if ($itemsSelected['location']) {
                    $sessionTotalBuy = 0;
                    foreach ($itemsSelected['location'] as $dataLocation) {
                        if($dataLocation['quantity'] > 0){
                            $gudang = $item->item->locations->find($dataLocation['location_id']);
                            if ($gudang) {
                                $newQuantity = max(0, $gudang->pivot->quantity - $dataLocation['quantity']);
                                $shortage = max(0, $dataLocation['quantity'] - $gudang->pivot->quantity);
                                $totalQty += $shortage;
                                $sessionTotalBuy += $shortage;
                                $buyPrice += ($shortage * $item->item->price);
                                $item->item->locations()->updateExistingPivot($dataLocation['location_id'], ['quantity' => $newQuantity]);
                            }
                        }
                    }
                    $item->quantity_buy = $sessionTotalBuy;
                    $item->save();
                }

            }
        }

        if($totalQty > 0 ){
            $totalApprovedItems = $requestDetails->count();
            $transaction = Transaction::create([
                'staff_id' => $request_tabel['staff_id'],
                'request_id' => $data['request_id'],
                'total_qty' => $totalQty,
                'total_price' => $buyPrice,
                'total_appoved_items' => $totalApprovedItems,
                'status' => 'unpaid',
            ]);
        return $transaction;

        }
      
    }

    public function getAllTransaction()
    {
        return Transaction::with([
            'requestItem' => function ($query) {
                $query->select("id", "nama_pemohon");
            },
            'staff' => function ($query) {
                $query->select("id", "name");
            },
            'requestItem.requestDetails' => function ($query) {
                $query->select("id", "item_id", 'request_id', 'quantity', 'status')->where('status', 'accepted');
            },
            'requestItem.requestDetails.item' => function ($query) {
                $query->select("id", "name", "unit_id", "price");
            },
            'requestItem.requestDetails.item.unit' => function ($query) {
                $query->select("id", "name");
            }
        ]);
    }


    public function transactionPay($id, $nominal)
    {
        $data = Transaction::find($id);

        if ($data) {
            if (($data->dibayarkan + $nominal) > $data->total_price) {
                $data->dibayarkan = $data['total_price'];
            } else {
                $data->dibayarkan += $nominal;
            }
            $data->status = ($data->dibayarkan >= $data->total_price) ? 'paid' : 'bon';
            $data->save();
            return true;
        }
        return false;
    }


    public function detailOwnInvoice($id)
    {
        return Transaction::with([
            'requestItem' => function ($query) use ($id) {
                $query->select("id", "nama_pemohon");
            },
            'requestItem.requestDetails' => function ($query) {
                $query->select("id", "item_id", 'request_id', 'quantity', 'status')->where('status', 'accepted');
            },
            'requestItem.requestDetails.item' => function ($query) {
                $query->select("id", "name", "price");
            }
        ])->find($id);
    }

    public function listOwnInvoice($id)
    {
        return Transaction::with([
            'requestItem' => function ($query) use ($id) {
                $query->select("id", "nama_pemohon");
            }
        ])->where('staff_id', $id)->select('id', 'total_price', 'total_qty', 'status', 'created_at', 'request_id')->get();
    }
}
