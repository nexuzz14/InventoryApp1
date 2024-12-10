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
            ->select('request_items.customer_id', 'items_request_details.quantity', 'items.price')
            ->get();
        $totalQty = $requestItems->sum('quantity');
        $totalPrice = $requestItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        $totalApprovedItems = $requestItems->count();
        $customerId = $requestItems[0]->customer_id;

        $transaction = Transaction::create([
            'customer_id' => $customerId,
            'request_id' => $data['request_id'],
            'total_qty' => $totalQty,
            'total_price' => $totalPrice,
            'total_appoved_items' => $totalApprovedItems,
            'status' => 'unpaid',
        ]);
        return $transaction;
    }
}