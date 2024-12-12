<?php

namespace App\Services;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function storeTransaction($data)
    {
        $requestItems = DB::table('request_items')
            ->where('request_items.id', $data['request_id'])
            ->where('items_request_details.status', 'accepted')
            ->join('items_request_details', 'request_items.id', '=', 'items_request_details.request_id')
            ->join('items', 'items.id', '=', 'items_request_details.item_id')
            ->select('request_items.staff_id', 'items_request_details.quantity', 'items.price')
            ->get();
        if ($requestItems) {
            DB::table('request_items')
                ->where('request_items.id', $data['request_id'])
                ->update(['status' => 'selesai']);
        }
        $totalQty = $requestItems->sum('quantity');
        $totalPrice = $requestItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        $totalApprovedItems = $requestItems->count();
        $customerId = $requestItems[0]->staff_id;

        $transaction = Transaction::create([
            'staff_id' => $customerId,
            'request_id' => $data['request_id'],
            'total_qty' => $totalQty,
            'total_price' => $totalPrice,
            'total_appoved_items' => $totalApprovedItems,
            'status' => 'unpaid',
        ]);
        return $transaction;
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

            }else{
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
