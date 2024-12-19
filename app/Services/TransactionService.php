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
    public function __construct(ItemService $ItemService)
    {
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
                        if ($dataLocation['quantity'] > 0) {
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
                    if($sessionTotalBuy > 0 && $itemsSelected['suppliers']){
                        foreach ($itemsSelected['suppliers'] as $supplier) {
                            $item->suppliers()->attach($supplier['supplier_id'], ['quantity' => $supplier['quantity']]);
                        }
                    }
                    $item->quantity_buy = $sessionTotalBuy;
                    $item->save();
                }
            }
        }

        $request_tabel->status = "selesai";
        $request_tabel->save();

        if ($totalQty > 0) {

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
    public function getDetailTransaction($id) {
        $transaction = Transaction::with([
            'requestItem.client',
            'requestItem.requestDetails.item',
            'requestItem.requestDetails.suppliers'

        ])->find($id);
        if( $transaction){


            $data = [
                'created_at' => $transaction->created_at,
                'total_price' => $transaction->total_price,
                'dibayarkan' => $transaction->dibayarkan,
                'status' => $transaction->status,
                'request_item' => [
                    'code' => $transaction->requestItem->code ?? null,
                    'client_name' => $transaction->requestItem->client->name ?? null,
                    'request_details' => $transaction->requestItem->requestDetails->map(function ($detail) {
                        return [
                            'quantity_buy' => $detail->quantity_buy,
                            'item_name' => $detail->item->name ?? null,
                            'item_price' => $detail->item->price ?? null,
                        ];
                    }),
                ],
                'suppliers' => $transaction->requestDetails->suppliers->map(function ($supplier) {
                    return [
                        'id' => $supplier->pivot->id,
                        'name' => $supplier->pivot->name ?? null,
                    ];
                }),
            ];

            return $data;

        }
    }

    public function pay($id){
        $transaction = Transaction::with('requestItem.requestDetails.item')->find($id);

        if ($transaction) {
            // Update dibayarkan menjadi total_price
            $transaction->dibayarkan = $transaction->total_price;
            Log::debug($transaction->requestItem);

            // Loop untuk memperbarui quantity item
            foreach ($transaction->requestItem->requestDetails as $req) {
                $req->item->quantity += $req->quantity_buy;
                $req->item->save();
            }

            $transaction->status = "paid";
            $transaction->save();
            return true;
        }

        return false;

    }



    public function getAllTransaction()
    {
        // Ambil data transaksi dengan relasi suppliers
        $transactions = Transaction::with('suppliers', 'requestItem.client')
            ->select('id', 'created_at', 'total_qty') // Hanya kolom dari tabel 'transactions'
            ->get();

        // Transformasi data
        $data = $transactions->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'created_at' => $transaction->created_at,
                'request_item_code' => $transaction->requestItem->code ?? null,
                'client_name' => $transaction->requestItem->client->name ?? null,
                'quantity' => $transaction->total_qty,
                'suppliers' => $transaction->suppliers->map(function ($supplier) {
                    return [
                        'id' => $supplier->id,
                        'name' => $supplier->name ?? null,
                    ];
                }),
            ];
        });


        return $data;
    }

    public function delete($id){
        $data = Transaction::find($id);
        if($data){
            $data->delete();
            return true;
        }
        return false;
    }

    public function deleteRequest($id){
        $data = RequestItem::find($id);
        if($data){
            $data->delete();
            return true;
        }
        return false;
    }

    // public function getAllTransaction()
    // {
    //     return Transaction::with([
    //         'requestItem' => function ($query) {
    //             $query->select("id", "nama_pemohon");
    //         },
    //         'staff' => function ($query) {
    //             $query->select("id", "name");
    //         },
    //         'requestItem.requestDetails' => function ($query) {
    //             $query->select("id", "item_id", 'request_id', 'quantity', 'status')->where('status', 'accepted');
    //         },
    //         'requestItem.requestDetails.item' => function ($query) {
    //             $query->select("id", "name", "unit_id", "price");
    //         },
    //         'requestItem.requestDetails.item.unit' => function ($query) {
    //             $query->select("id", "name");
    //         }
    //     ]);
    // }


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
